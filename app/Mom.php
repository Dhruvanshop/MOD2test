<?php

namespace App;

error_reporting(E_ALL);
// Enable error display.
ini_set('display_errors', 1);

/**
 * class of man of the match
 */
class Mom
{   
    /**
     * function for man of the match 
     *
     * @param [array] $players
     * @return array
     */
    public function findManOfTheMatch($players)
    {
        $conn = mysqli_connect('localhost', 'dhruv', 'Dhruv@123', 'score');
        $result = mysqli_query($conn, "SELECT * FROM scorecard");
        $player = $result->fetch_all(MYSQLI_ASSOC);
        $highestStrikeRate = 0;
        $playerName = '';
        foreach ($player as $p) {
            $temp = ($p['run'] / $p['balls'])*100;
            if ($temp > $highestStrikeRate) {
                $highestStrikeRate = $temp;
                $playerName = $p['name'];
            }
        }
        return ['name' => $playerName, 'strikeRate' => $highestStrikeRate];
    }
}
//creating object of mom class
$manObj = new Mom();

$players = [];

//calling the findManOfTheMatch function 
$manOfTheMatch = $manObj->findManOfTheMatch($players);

//storing the result into $response
$response = [
    'name' => $manOfTheMatch['name'],
    'strikeRate' => $manOfTheMatch['strikeRate']
];

header('Content-Type: application/json');
echo json_encode($response);
