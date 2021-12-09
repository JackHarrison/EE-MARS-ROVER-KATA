<?php

$acceptedCommands = ['B','F','L','R'];
$directions = $_GET['directions'];

if (isset($_GET['directions']) && $directions != "") {
    $commands = str_split($directions);

    include './Kata.php';
    $rover = new Kata();

    $rover->initialCoords->x = 4;
    $rover->initialCoords->y = 2;
    $rover->initialCoords->direction = 'EAST';
    $rover->initialCoords->heading = $rover->directionValues[$rover->initialCoords->direction];

    foreach ($commands as $command) {
        echo '<pre>';
        if (in_array($command, $acceptedCommands)) {
            $rover->getNewPosition($command);
            echo '<pre>';
            echo 'ROVER IS FACING: ' . $rover->updatedCoords->direction . '<br>';
            echo 'ROVER IS AT: X:' . $rover->updatedCoords->x . ' Y:' . $rover->updatedCoords->y . '<br>';
            echo 'HEADING: ' . $rover->updatedCoords->heading . '&deg;' . '<br>';
            echo '<hr>';

        } else {
            echo 'UNHANDLED COMMAND STRING. COMMAND "' . $command . '" NOT KNOWN';
            echo '<hr>';
        }
        echo '</pre>';
    }
} else {
    echo '<pre>';
    echo "no commands found";
    echo '</pre>';
}