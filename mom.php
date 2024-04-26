<?php
require_once 'dashboard_db.php';

function findManOfTheMatch($players) {
    $highestStrikeRate = 0;
    $manOfTheMatch = null;

    foreach ($players as $player) {
        $strikeRate = $player->getStrikeRate();
        if ($strikeRate > $highestStrikeRate) {
            $highestStrikeRate = $strikeRate;
            $manOfTheMatch = $player;
        }
    }

    return $manOfTheMatch;
}

$players = getPlayers();
$manOfTheMatch = findManOfTheMatch($players);

$response = array(
    'name' => $manOfTheMatch->getName(),
    'strikeRate' => $manOfTheMatch->getStrikeRate()
);

header('Content-Type: application/json');
echo json_encode($response);

