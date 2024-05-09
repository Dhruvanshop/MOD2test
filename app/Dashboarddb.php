<?php
namespace App;

session_start();

use App\Database;

use App\Player;

/**
 * Dashboard Database class 
 */
class Dashboarddb extends Database
{
  public $db;
  /**
   * for creating the object of database
   */
  public function __construct() {
    $this->db = new Database();
  }

  /**
   * for the gettting the details of players
   *
   * @return array
   */
  public function getPlayers() {
    $players = array();
    $sql = "SELECT * FROM scorecard";
    $result = $this->db->conn->query($sql);
    if ($result->num_rows > 0) {

      while ($row = $result->fetch_assoc()) {

        $player = new Player($row['player_id'], $row['name'], $row['run'], $row['balls']);
        $players[] = $player;

      }
    }
    return $players;
  }
  
  /**
   * for adding a player
   *
   * @param [string] $name
   * @param [int] $run
   * @param [int] $balls
   * @return void
   */
  public function addPlayer($name, $run, $balls)
  {
    $sql = "SELECT * FROM scorecard";
    $result = $this->db->conn->query($sql);
    if ($result->num_rows >= 11) {
      echo '<script>alert("already 11 players are added cant add more")</script>';
    } else {
      $sql = "INSERT INTO scorecard (name, run, balls) VALUES ('$name', $run, $balls)";
      $this->db->conn->query($sql);
    }

  }

  /**
   * for updating a details of a player
   *
   * @param [int] $id
   * @param [string] $name
   * @param [int] $run
   * @param [int] $balls
   * @return void
   */
  public function updatePlayer($id, $name, $run, $balls)
  {
    $sql = "UPDATE scorecard SET name='$name', run=$run, balls=$balls WHERE player_id=$id";
    $this->db->conn->query($sql);
  }
  /**
   * delete a player record
   *
   * @param [int] $id
   * @return void
   */
  public function deletePlayer($id)
  {
    $sql = "DELETE FROM scorecard WHERE player_id=$id";
    $this->db->conn->query($sql);
  }
}
//creating a object of dashborddb class 
$playerobj = new Dashboarddb();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  //if  clicked on add button in dashboard
  if (isset($_POST['add'])) {
    $name = $_POST["name"];
    $run = $_POST["run"];
    $balls = $_POST["balls"];
    $playerobj->addPlayer($name, $run, $balls);
  }
  // if clicked on edit 
  elseif (isset($_POST['edit'])) {
    $id = $_POST["player_id"];
    $name = $_POST["name"];
    $run = $_POST["run"];
    $balls = $_POST["balls"];
    $playerobj->updatePlayer($id, $name, $run, $balls);
  }
 // if clicked on delete
  elseif (isset($_POST['delete'])) {
    $id = $_POST["player_id"];
    $playerobj->deletePlayer($id);
  }
}
$players = $playerobj->getPlayers();
