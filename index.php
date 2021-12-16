<?php

$directions = $_GET['directions'];
include './Kata.php';
$rover = new Kata();

if (isset($_GET['directions']) && $directions != "") {
    $commands = str_split($directions);

    $rover->initialCoords->x = 0;
    $rover->initialCoords->y = 0;
    $rover->initialCoords->direction = 'WEST';
    $rover->initialCoords->heading = $rover->directionValues[$rover->initialCoords->direction];

    foreach ($commands as $command) {
        if (in_array($command, $rover->acceptedCommands)) {
            $rover->getNewPosition($command);
            $rover->printResults('success');
        } else {
            $rover->printResults($command);
        }
    }
} else {
    $rover->printResults('nocommand');
}


