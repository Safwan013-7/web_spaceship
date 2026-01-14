<?php 
require_once "spaceShip.php";
require_once "../Entiteiten/canon.php";
require_once "../Entiteiten/shield.php";

$SpaceShip = new Spaceship(naam: "Destroyer ", lengte: 6 , HP: 7 , aanval: 2 );
echo($SpaceShip->__getName());



$SpaceShip ->__setName("Hadj Younes ");
echo($SpaceShip->__getName());

echo ($SpaceShip->__getLength());
echo ($SpaceShip->__getHP());   
echo ($SpaceShip->__getAttack());

// Create a Canon object
$canon = new Canon(Name: "Laser Cannon", MinDamage: 5, MaxDamage: 15, Recharge: 2, RechargeTime: 3);
$SpaceShip->__AddCanon($canon);

// Create a Shield object
$shield = new Shield(Name: "Energy Shield", Durabillity: 50, Recharge: 10, RechargeTime: 5);
$SpaceShip->__AddShield($shield);

echo "Canon added and Shield added successfully!";
?>
