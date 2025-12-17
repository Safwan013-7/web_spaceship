<?php

class Spaceship
{
    public $id;
    public $naam;
    public $lengte;
    public $hp;
    public $aanval;

    public function __construct($id = null, $naam = '', $lengte = 0, $hp = 0, $aanval = 0)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->lengte = $lengte;
        $this->hp = $hp;
        $this->aanval = $aanval;
    }
}

?>