<?php 
require_once "./PHP/spaceShip.php";

$SpaceShip = new Spaceship(naam: "Destroyer ", lengte: 6 , HP: 7 , aanval: 2 );
echo($SpaceShip->__getName());



$SpaceShip ->__setName("Hadj Younes ");
echo($SpaceShip->__getName());

echo ($SpaceShip->__getLength());
echo ($SpaceShip->__getHP());   
echo ($SpaceShip->__getAttack());

?>
