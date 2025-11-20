<?php 
class Spaceship
{
    public string $naam;
    public int $lengte;
    public int $HP;
    public int  $aanval;        
    public function __construct(string $naam, int $lengte, int $HP, int $aanval )
   {
 $this->naam = $naam;
 $this->lengte = $lengte;
 $this->HP = $HP;
 $this->aanval = $aanval;

   }

   public function __getName() : string
   {

    return $this->naam;
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

   public function __setName(string $naam) : void
   {
    $this->naam = $naam;
   }

};
?>