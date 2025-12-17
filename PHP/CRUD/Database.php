<?php

class Database
{
    private $servernaam = "localhost";
    private $gebruiker = "root";
    private $wachtwoord = "root";
    private $database = "spaceship";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servernaam, $this->gebruiker, $this->wachtwoord, $this->database);
        if ($this->conn->connect_error) {
            throw new Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function closeConnection()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

?>