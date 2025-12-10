<?php

require_once __DIR__ . '/Entiteit.php';

class Canon extends Entiteit
{
   public string $Name;
   public int $MinDamage;
   public int $MaxDamage;
   public int $Recharge;
   public int $RechargeTime;

   public function __construct(string $Name, int $MinDamage, int $MaxDamage, int $Recharge, int $RechargeTime)
   {
      $this->Name = $Name;
      $this->MinDamage = $MinDamage;
      $this->MaxDamage = $MaxDamage;
      $this->Recharge = $Recharge;
      $this->RechargeTime = $RechargeTime;
   }

}

?>
?>