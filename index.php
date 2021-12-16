<?php

$directions = $_GET['directions'];
include './Kata.php';
$rover = new Kata();

if ($rover->getCommand($directions)) {

    $commands = str_split($directions);
    $rover->setInitialCoords(0, 0, 'WEST');
    $rover->printResults('initial');
    $rover->runCommands($commands);
} else {
    $rover->printResults('nocommand');
}


