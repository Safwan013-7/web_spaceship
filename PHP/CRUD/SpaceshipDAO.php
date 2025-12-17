<?php

require_once 'Database.php';
require_once 'Spaceship.php';

class SpaceshipDAO
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllSpaceships()
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT id, naam, lengte, hp, aanval FROM ship";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($id, $naam, $lengte, $hp, $aanval);
        $spaceships = [];
        while ($stmt->fetch()) {
            $spaceships[] = new Spaceship($id, $naam, $lengte, $hp, $aanval);
        }
        $stmt->close();
        $this->db->closeConnection();
        return $spaceships;
    }

    public function getSpaceshipById($id)
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT id, naam, lengte, hp, aanval FROM ship WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $naam, $lengte, $hp, $aanval);
        $spaceship = null;
        if ($stmt->fetch()) {
            $spaceship = new Spaceship($id, $naam, $lengte, $hp, $aanval);
        }
        $stmt->close();
        $this->db->closeConnection();
        return $spaceship;
    }

    public function createSpaceship(Spaceship $spaceship)
    {
        $conn = $this->db->getConnection();
        $query = "INSERT INTO ship (naam, lengte, hp, aanval) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("siii", $spaceship->naam, $spaceship->lengte, $spaceship->hp, $spaceship->aanval);
        $result = $stmt->execute();
        $stmt->close();
        $this->db->closeConnection();
        return $result;
    }

    public function updateSpaceship(Spaceship $spaceship)
    {
        $conn = $this->db->getConnection();
        $query = "UPDATE ship SET naam = ?, lengte = ?, hp = ?, aanval = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("siiii", $spaceship->naam, $spaceship->lengte, $spaceship->hp, $spaceship->aanval, $spaceship->id);
        $result = $stmt->execute();
        $stmt->close();
        $this->db->closeConnection();
        return $result;
    }

    public function deleteSpaceship($id)
    {
        $conn = $this->db->getConnection();
        $sql = "DELETE FROM ship WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        $this->db->closeConnection();
        return $result;
    }
}

?>