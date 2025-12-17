<?php

require_once 'SpaceshipDAO.php';

class CrudApplication
{
    private $spaceshipDAO;

    public function __construct()
    {
        $this->spaceshipDAO = new SpaceshipDAO();
    }

    public function handleRequest()
    {
        $action = $_GET['action'] ?? 'list';
        switch ($action) {
            case 'create':
                $this->createSpaceship();
                break;
            case 'read':
                $this->readSpaceship();
                break;
            case 'update':
                $this->updateSpaceship();
                break;
            case 'delete':
                $this->deleteSpaceship();
                break;
            default:
                $this->listSpaceships();
                break;
        }
    }

    private function listSpaceships()
    {
        $spaceships = $this->spaceshipDAO->getAllSpaceships();
        echo "<h1>Spaceship List</h1>";
        echo "<a href='?action=create'>Create New Spaceship</a><br><br>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>Length</th><th>HP</th><th>Attack</th><th>Actions</th></tr>";
        foreach ($spaceships as $spaceship) {
            echo "<tr>";
            echo "<td>" . $spaceship->id . "</td>";
            echo "<td>" . htmlspecialchars($spaceship->naam) . "</td>";
            echo "<td>" . $spaceship->lengte . "</td>";
            echo "<td>" . $spaceship->hp . "</td>";
            echo "<td>" . $spaceship->aanval . "</td>";
            echo "<td>";
            echo "<a href='?action=read&id=" . $spaceship->id . "'>Read</a> | ";
            echo "<a href='?action=update&id=" . $spaceship->id . "'>Update</a> | ";
            echo "<a href='?action=delete&id=" . $spaceship->id . "'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    private function createSpaceship()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $spaceship = new Spaceship(null, $_POST['naam'], (int)$_POST['lengte'], (int)$_POST['hp'], (int)$_POST['aanval']);
            if ($this->spaceshipDAO->createSpaceship($spaceship)) {
                echo "Spaceship created successfully!";
                echo "<br><a href='?'>Back to list</a>";
            } else {
                echo "Error creating spaceship.";
            }
        } else {
            echo "<h1>Create Spaceship</h1>";
            echo "<form method='post'>";
            echo "Name: <input type='text' name='naam' required><br>";
            echo "Length: <input type='number' name='lengte' required><br>";
            echo "HP: <input type='number' name='hp' required><br>";
            echo "Attack: <input type='number' name='aanval' required><br>";
            echo "<input type='submit' value='Create'>";
            echo "</form>";
            echo "<a href='?'>Back to list</a>";
        }
    }

    private function readSpaceship()
    {
        $id = (int)$_GET['id'];
        $spaceship = $this->spaceshipDAO->getSpaceshipById($id);
        if ($spaceship) {
            echo "<h1>Spaceship Details</h1>";
            echo "ID: " . $spaceship->id . "<br>";
            echo "Name: " . htmlspecialchars($spaceship->naam) . "<br>";
            echo "Length: " . $spaceship->lengte . "<br>";
            echo "HP: " . $spaceship->hp . "<br>";
            echo "Attack: " . $spaceship->aanval . "<br>";
            echo "<a href='?'>Back to list</a>";
        } else {
            echo "Spaceship not found.";
        }
    }

    private function updateSpaceship()
    {
        $id = (int)$_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $spaceship = new Spaceship($id, $_POST['naam'], (int)$_POST['lengte'], (int)$_POST['hp'], (int)$_POST['aanval']);
            if ($this->spaceshipDAO->updateSpaceship($spaceship)) {
                echo "Spaceship updated successfully!";
                echo "<br><a href='?'>Back to list</a>";
            } else {
                echo "Error updating spaceship.";
            }
        } else {
            $spaceship = $this->spaceshipDAO->getSpaceshipById($id);
            if ($spaceship) {
                echo "<h1>Update Spaceship</h1>";
                echo "<form method='post'>";
                echo "Name: <input type='text' name='naam' value='" . htmlspecialchars($spaceship->naam) . "' required><br>";
                echo "Length: <input type='number' name='lengte' value='" . $spaceship->lengte . "' required><br>";
                echo "HP: <input type='number' name='hp' value='" . $spaceship->hp . "' required><br>";
                echo "Attack: <input type='number' name='aanval' value='" . $spaceship->aanval . "' required><br>";
                echo "<input type='submit' value='Update'>";
                echo "</form>";
                echo "<a href='?'>Back to list</a>";
            } else {
                echo "Spaceship not found.";
            }
        }
    }

    private function deleteSpaceship()
    {
        $id = (int)$_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['confirm'] === 'yes') {
                if ($this->spaceshipDAO->deleteSpaceship($id)) {
                    echo "Spaceship deleted successfully!";
                } else {
                    echo "Error deleting spaceship.";
                }
            }
            echo "<br><a href='?'>Back to list</a>";
        } else {
            $spaceship = $this->spaceshipDAO->getSpaceshipById($id);
            if ($spaceship) {
                echo "<h1>Delete Spaceship</h1>";
                echo "Are you sure you want to delete '" . htmlspecialchars($spaceship->naam) . "'?<br>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='confirm' value='yes'>";
                echo "<input type='submit' value='Yes, Delete'>";
                echo "</form>";
                echo "<a href='?'>Cancel</a>";
            } else {
                echo "Spaceship not found.";
            }
        }
    }
}

// Usage
$app = new CrudApplication();
$app->handleRequest();

?>