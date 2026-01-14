<?php

require_once __DIR__ . '/../Interfaces/IMovable.php';

class Spaceship implements IMovable
{
    public $id;
    public $naam;
    public $lengte;
    public $hp;
    public $aanval;
    public $position = 0;

    public function __construct($id = null, $naam = '', $lengte = 0, $hp = 0, $aanval = 0)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->lengte = $lengte;
        $this->hp = $hp;
        $this->aanval = $aanval;
    }

    public function move(int $distance): void
    {
        $this->position += $distance;
    }

    public function getPosition(): int
    {
        return $this->position;
    }
}

?>