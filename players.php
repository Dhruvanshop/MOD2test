<?php
/**
 * class for returning details of player
 */

class Player {
  /**
   * id of player
   * 
   * @var [int]
   */
  private $id;
  /**
   * players name
   *
   * @var [string]
   */
  private $name;
  /**
   * scored run
   *
   * @var [string]
   */
  private $run;
  /**
   * balls faced
   *
   * @var [string]
   */
  private $balls;

  // Constructor
  public function __construct($player_id, $name, $run, $balls) {
    $this->id = $player_id;
    $this->name = $name;
    $this->run = $run;
    $this->balls = $balls;
  }

  /**
  * this function returns the id
  *
  * @return int
  */
  public function getId() {
    return $this->id;
  }
  /**
  * this function returns name
  *
  * @return string
  */
  public function getName() {
    return $this->name;
  }
  
  /**
  * function returns run scored
  *
  * @return int
  */
  public function getrun() {
    return $this->run;
  }
  /**
  * for returning the balls
  *
  * @return int
  */
  public function getBalls() {
    return $this->balls;
  }

  /**
  * for calculating the strikerate
  *
  * @return int
  */
  public function getStrikeRate() {
    return ($this->run / $this->balls) * 100;
  }
  /**
   * function to update players details and scored run by him
   *
   * @param [string] $name
   * @param [int] $run
   * @param [int] $balls
   * @return void
   */
  public function updatePlayer($name, $run, $balls) {
    $this->name = $name;
    $this->run = $run;
    $this->balls = $balls;
  }
}

