<?php
require_once '../Entiteiten/Entiteit.php';
require_once '../Entiteiten/canon.php';
require_once '../Entiteiten/shield.php';
require_once '../interfaces/IMovable.php';
require_once '../interfaces/IWeapon.php';
require_once '../interfaces/IDefense.php';

class Spaceship extends Entiteit implements IMovable, IWeapon, IDefense
{
    public string $naam;
    public int $lengte;
    public int $HP;
    public int  $aanval;   
    public array $Cannons = [];
    public array $Shields = [];
    public int $position = 0;

    public function __construct(string $naam, int $lengte, int $HP, int $aanval )     
   {
 $this->naam = $naam;
 $this->lengte = $lengte;
 $this->HP = $HP;
 $this->aanval = $aanval;
 $this->Cannons = [];

   }

   public function __getName() : string
   {

    return $this->naam;
   }

     public function __setName(string $naam) : void
   {
    $this->naam = $naam;
   }


   public function __getLength() : int
   {

    return $this->lengte;
   }    

   public function __getHP() : int
   {

    return $this->HP;
   }

   public function __getAttack() : int
   {

    return $this->aanval;
   }

 
   public function __AddCanon(Canon $Canon)
    {
        $this->Cannons[] = $Canon;
    }

    public function __AddShield(Shield $Shield)
    {
        $this->Shields[] = $Shield;
    }

    public function move(int $distance): void
    {
        $this->position += $distance;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function getDamage(): int
    {
        $totalDamage = 0;
        foreach ($this->Cannons as $canon) {
            $totalDamage += $canon->getDamage();
        }
        return $totalDamage;
    }

    public function fire(): int
    {
        return $this->getDamage();
    }

    public function absorbDamage(int $damage): int
    {
        foreach ($this->Shields as $shield) {
            if ($damage <= 0) break;
            $damage = $shield->absorbDamage($damage);
        }
        return $damage;
    }

    public function isActive(): bool
    {
        foreach ($this->Shields as $shield) {
            if ($shield->isActive()) return true;
        }
        return false;
    }
}