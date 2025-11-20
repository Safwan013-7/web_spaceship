<?php
require_once "spaceShip.php";

class Battle
{
    public Spaceship $a;
    public Spaceship $b;
    public int $round = 0;
    public array $log = [];

    public function __construct(Spaceship $a, Spaceship $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    private function attack(Spaceship $attacker, Spaceship $defender): int
    {
        // small randomness around attack value
        $variation = rand(-1, 1);
        $damage = max(1, $attacker->__getAttack() + $variation);
        $defender->HP -= $damage;
        return $damage;
    }

    public function simulate(): string
    {
        $this->log[] = "Battle start: {$this->a->__getName()} vs {$this->b->__getName()}";

        while ($this->a->__getHP() > 0 && $this->b->__getHP() > 0) {
            $this->round++;
            $this->log[] = "-- Round {$this->round} --";

            // choose who attacks first randomly each round
            $first = (rand(0, 1) === 0) ? 'a' : 'b';

            if ($first === 'a') {
                $dmg = $this->attack($this->a, $this->b);
                $this->log[] = "{$this->a->__getName()} hits {$this->b->__getName()} for {$dmg} damage (HP left: {$this->b->__getHP()})";
                if ($this->b->__getHP() <= 0) break;

                $dmg = $this->attack($this->b, $this->a);
                $this->log[] = "{$this->b->__getName()} hits {$this->a->__getName()} for {$dmg} damage (HP left: {$this->a->__getHP()})";
            } else {
                $dmg = $this->attack($this->b, $this->a);
                $this->log[] = "{$this->b->__getName()} hits {$this->a->__getName()} for {$dmg} damage (HP left: {$this->a->__getHP()})";
                if ($this->a->__getHP() <= 0) break;

                $dmg = $this->attack($this->a, $this->b);
                $this->log[] = "{$this->a->__getName()} hits {$this->b->__getName()} for {$dmg} damage (HP left: {$this->b->__getHP()})";
            }
        }

        $winner = ($this->a->__getHP() > 0) ? $this->a->__getName() : $this->b->__getName();
        $this->log[] = "Battle finished in {$this->round} rounds. Winner: {$winner}";

        return implode("\n", $this->log);
    }
}

// helper to read int or default
function get_int_param(string $key, int $default): int
{
    if (isset($_GET[$key]) && is_numeric($_GET[$key])) {
        return (int) $_GET[$key];
    }
    return $default;
}

// read params or use defaults
$a_name = isset($_GET['a_name']) ? $_GET['a_name'] : 'Destroyer A';
$b_name = isset($_GET['b_name']) ? $_GET['b_name'] : 'Battleship B';
$a_hp = get_int_param('a_hp', 10);
$b_hp = get_int_param('b_hp', 10);
$a_attack = get_int_param('a_attack', 3);
$b_attack = get_int_param('b_attack', 3);
$a_length = get_int_param('a_length', 6);
$b_length = get_int_param('b_length', 6);

$shipA = new Spaceship(naam: $a_name, lengte: $a_length, HP: $a_hp, aanval: $a_attack);
$shipB = new Spaceship(naam: $b_name, lengte: $b_length, HP: $b_hp, aanval: $b_attack);

$battle = new Battle($shipA, $shipB);
$result = $battle->simulate();

header('Content-Type: text/plain; charset=utf-8');
echo $result;

?>
