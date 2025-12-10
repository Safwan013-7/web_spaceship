<?php

require_once __DIR__ . '/Entiteit.php';

class Shield extends Entiteit
{
    public string $Name;
    public int $Durabillity;
    public int $Recharge;
    public int $RechargeTime;


    public function __construct(string $Name,int $Durabillity,int $Recharge, int $RechargeTime)
    {
        $this->Name = $Name;
        $this->Durabillity = $Durabillity;
        $this->Recharge = $Recharge;
        $this->RechargeTime = $RechargeTime;
    }
}
