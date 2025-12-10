<?php
require_once 'Entiteiten/Entiteit.php';
require_once 'Entiteiten/canon.php';
require_once 'Entiteiten/shield.php';

class Spaceship extends Entiteit
{
    public string $naam;
    public int $lengte;
    public int $HP;
    public int  $aanval;   
    public array $Cannons = [];
    public array $Shields = [];
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

};
?>