<?php

class Kata
{

    public array $directionValues = ['EAST' => 270, 'WEST' => 90, 'NORTH' => 360, 'SOUTH' => 180];
    public array $acceptedCommands = ['B','F','L','R'];
    private int $maxHeading = 360;
    private int $minHeading = 0;

    public object $initialCoords;
    public object $updatedCoords;


    /**
     * @param $command
     */
    public function getNewPosition($command)
    {
        $this->updatedCoords = $this->initialCoords;

        switch ($command) {
            case 'F':
                $this->changePositionalValueDependingOnDirection($this->updatedCoords->direction, 1);
                break;
            case 'B':
                $this->changePositionalValueDependingOnDirection($this->updatedCoords->direction, -1);
                break;
            case 'L':
            case 'R':
                $this->updatedCoords->heading = $this->fixHeading($command, $this->updatedCoords->heading);
                $this->updatedCoords->direction = $this->changeDirectionStringDependingOnHeading();
                break;
        }

    }



    /**
     * @param $direction
     * fixes  the issue that 0 degrees is unhandled - I convert this to 360 for abs north
     */
    public function fixHeading($direction, $heading)
    {
        switch ($direction){
            case 'L':

                if ($heading == 90) {
                    return $this->maxHeading;
                } else {
                    return $heading -= 90;
                }
            case 'R':

                if ($heading == $this->maxHeading) {
                    return $this->minHeading;
                }
                return $heading += 90;
        }
    }


    /**
     * @param $value
     */
    public function changePositionalValueDependingOnDirection($direction, $value)
    {
        if ($direction === 'EAST') {
            $this->updatedCoords->x -= $value;
        }

        if ($direction === 'WEST') {
            $this->updatedCoords->x += $value;
        }

        if ($direction === 'NORTH') {
            $this->updatedCoords->y += $value;
        }

        if ($direction === 'SOUTH') {
            $this->updatedCoords->y -= $value;
        }

    }


    /**
     * @return false|int|string
     */
    public function changeDirectionStringDependingOnHeading()
    {
        return array_search($this->updatedCoords->heading, $this->directionValues);
    }


    /**
     * @param $result // success, no command received or an unknown command
     */
    public function printResults ($result) {
        echo '<pre>';
        switch ($result){
            case 'success':
                echo 'ROVER IS FACING: ' . $this->updatedCoords->direction . '<br>';
                echo 'ROVER IS AT: X:' . $this->updatedCoords->x . ' Y:' . $this->updatedCoords->y . '<br>';
                echo 'HEADING: ' . $this->updatedCoords->heading . '&deg;' . '<br>';
                echo '<hr>';
                break;
            case 'nocommand':
                echo "NO COMMAND RECEIVED";
                echo '<hr>';
                break;
            default:
                echo 'UNHANDLED COMMAND STRING. COMMAND "' . $result . '" NOT KNOWN';
                echo '<hr>';
                break;
        }
        echo '</pre>';
    }

}
