<?php
session_start();

require_once 'Database.php';
require_once 'players.php';

$db = new Database();

// Function to fetch players from the database
function getPlayers()
{
  global $db;
  $players = array();
  $sql = "SELECT * FROM scorecard";
  $result = $db->conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $player = new Player($row['player_id'], $row['name'], $row['run'], $row['balls']);
      $players[] = $player;
    }
  }
  return $players;
}

// Function to add a new player
function addPlayer($name, $run, $balls)
{
  global $db;
  $sql = "SELECT * FROM scorecard";
  $result = $db->conn->query($sql);
  if ($result->num_rows >=11){
    echo '<script>alert("already 11 players are added cant add more")</script>';
    // header("Location: dashboard.php");
  }
  else { 
    $sql = "INSERT INTO scorecard (name, run, balls) VALUES ('$name', $run, $balls)";
    $db->conn->query($sql);
  }

}

// Function to update player information
function updatePlayer($id, $name, $run, $balls)
{
  global $db;
  $sql = "UPDATE scorecard SET name='$name', run=$run, balls=$balls WHERE player_id=$id";
  $db->conn->query($sql);
}

// Function to delete a player
function deletePlayer($id)
{
  global $db;
  $sql = "DELETE FROM scorecard WHERE player_id=$id";
  $db->conn->query($sql);
}

// Process form submissions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST['add'])) {
    $name = $_POST["name"];
    $run= $_POST["run"];
    $balls = $_POST["balls"];
    addPlayer($name, $run, $balls);
  }
  elseif (isset($_POST['edit'])) {
    $id = $_POST["player_id"];
    $name = $_POST["name"];
    $run = $_POST["run"];
    $balls = $_POST["balls"];
    updatePlayer($id, $name, $run, $balls);
  }
  elseif (isset($_POST['delete'])) {
    $id = $_POST["player_id"];
    deletePlayer($id);
  }
}

$players = getPlayers();