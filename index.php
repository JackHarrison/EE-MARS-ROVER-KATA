<?php

$directions = $_GET['directions'];

$directionValues = ['EAST' => 270, 'WEST' => 90, 'NORTH' => 360, 'SOUTH' => 180];
$acceptedCommands = ['B'.'F','L','R'];

$maxHeading = 360;
$minHeading = 0;

$initialCoords = (object)array();
$initialCoords->x = 4;
$initialCoords->y = 2;
$initialCoords->direction = 'EAST';
$initialCoords->heading = $directionValues[$initialCoords->direction];

$updatedCoords = (object)array();
$updatedCoords = $initialCoords;

$commands = str_split($directions, 1);


foreach ($commands as &$command) {
    echo '<pre>';
    if (in_array($command, $acceptedCommands)) {
        getNewPosition($command);
        echo '<pre>';
        echo 'ROVER IS FACING: ' . $updatedCoords->direction . '<br>';
        echo 'ROVER IS AT: X:' . $updatedCoords->x . ' Y:' . $updatedCoords->y . '<br>';
        echo 'HEADING: ' . $updatedCoords->heading . '&deg;' . '<br>';
        echo '<hr>';

    } else {
        echo 'UNHANDLED COMMAND STRING';
        echo '<hr>';
    }
    echo '</pre>';
}


function getNewPosition($command)
{
    global $updatedCoords, $maxHeading, $minHeading;
    switch ($command) {
        case 'F':
            changePositionalValueDependingOnDirection(1);
            break;
        case 'B':
            changePositionalValueDependingOnDirection(-1);
            break;
        case 'L':

            if ($updatedCoords->heading == 90){
                $updatedCoords->heading = $maxHeading;
            } else {
                $updatedCoords->heading -= 90;
            }

            $updatedCoords->direction = changeDirectionStringDepeningOnHeading();
            break;
        case 'R':

            if ($updatedCoords->heading == $maxHeading){
                $updatedCoords->heading = $minHeading;
            }

            $updatedCoords->heading += 90;
            $updatedCoords->direction = changeDirectionStringDepeningOnHeading();
            break;
    }
}


function changePositionalValueDependingOnDirection($value)
{
    global $updatedCoords;

    switch ($updatedCoords->direction) {
        case 'WEST':
        case 'EAST':
            $updatedCoords->x += $value;
            break;
        case 'NORTH':
        case 'SOUTH':
            $updatedCoords->y +=$value;
            break;
    }
}


function changeDirectionStringDepeningOnHeading()
{
    global $updatedCoords, $directionValues;
    $val = array_search($updatedCoords->heading, $directionValues);
    return $val;
}





