<?php

class Kata
{

    public array $directionValues = ['EAST' => 270, 'WEST' => 90, 'NORTH' => 360, 'SOUTH' => 180];
    public array $acceptedCommands = ['B', 'F', 'L', 'R'];
    private int $maxHeading = 360;
    private int $minHeading = 0;
    private int $incrementer = 1;
    private int $decrementer = -1;
    private string $defaultValue = '';
    public object $initialCoords;
    public object $updatedCoords;


    /**
     * @param $index
     * @return mixed|string
     */
    public function getCommand($index)
    {
        return count($index) ? $index : $this->defaultValue;
    }


    /**
     * @param $commands
     */
    public function runCommands($commands)
    {
        foreach ($commands as $command) {
            in_array($command, $this->acceptedCommands) ? $this->getNewPosition($command) : $this->printResults($command);
        }
    }


    /**
     * @param $x
     * @param $y
     * @param $dir
     */
    public function setInitialCoords($x, $y, $dir)
    {
        $this->initialCoords->x = $x;
        $this->initialCoords->y = $y;
        $this->initialCoords->direction = $dir;
        $this->initialCoords->heading = $this->directionValues[$this->initialCoords->direction];

        $this->updatedCoords = $this->initialCoords;
    }


    /**
     * @param $command
     */
    public function getNewPosition($command)
    {
        switch ($command) {
            case 'F':
                $this->changePositionalValueDependingOnDirection($this->getUpdatedCoordsValue('direction'), $this->incrementer);
                break;
            case 'B':
                $this->changePositionalValueDependingOnDirection($this->getUpdatedCoordsValue('direction'), $this->decrementer);
                break;
            case 'L':
            case 'R':
                $val = $this->getUpdatedCoordsValue('heading');
                $this->setUpdatedCoordsValue('heading', $this->fixHeading($command, $val));
                $this->setUpdatedCoordsValue('direction', $this->changeDirectionStringDependingOnHeading());
                break;
        }

        $this->printResults('success');

    }


    /**
     * @param $direction
     * @description  fixes the issue that 0 degrees is unhandled 360 is expected - I convert this to 360 for abs north
     */
    public function fixHeading($direction, $heading)
    {
        switch ($direction) {
            case 'L':

                if ($heading == 90) {
                    return $this->maxHeading;
                } else {
                    return $heading -= 90;
                }
            case 'R':

                if ($heading == $this->maxHeading) {
                    $heading = $this->minHeading;
                }
                return $heading += 90;
        }
    }


    /**
     * @param $value
     */
    public function changePositionalValueDependingOnDirection($direction, $value)
    {

        if ($direction === 'EAST' || $direction === 'WEST') {
            $prop = 'x';
            $val = $this->getUpdatedCoordsValue($prop);
            $direction == 'EAST' ? $val -= $value : $val += $value;
        } else {
            $prop = 'y';
            $val = $this->getUpdatedCoordsValue($prop);
            $direction == 'SOUTH' ? $val -= $value : $val += $value;
        }

        $this->setUpdatedCoordsValue($prop, $val);

    }


    /**
     * @return false|int|string
     */
    public function changeDirectionStringDependingOnHeading()
    {
        $val = $this->getUpdatedCoordsValue('heading');
        return array_search($val, $this->directionValues);
    }


    /**
     * @param $result
     * @description  success, command recieved and processed
     * @description  nocommand, no command received  - empty string
     * @description  default, unknown command string
     */
    public function printResults($result)
    {
        echo '<pre>';
        switch ($result) {
            case 'success':
                echo 'ROVER IS FACING: ' . $this->getUpdatedCoordsValue('direction') . '<br>';
                echo 'ROVER IS AT: X:' . $this->getUpdatedCoordsValue('x') . ' Y:' . $this->getUpdatedCoordsValue('y') . '<br>';
                echo 'HEADING: ' . $this->getUpdatedCoordsValue('heading') . '&deg;' . '<br>';
                echo '<hr>';
                break;
            case 'initial':
                echo 'ROVER IS FACING: ' . $this->initialCoords->direction . '<br>';
                echo 'ROVER IS AT: X:' . $this->initialCoords->x . ' Y:' . $this->getUpdatedCoordsValue('y') . '<br>';
                echo 'HEADING: ' . $this->initialCoords->heading . '&deg;' . '<br>';
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

    /**
     * @param $prop
     * @return mixed
     */
    private function getUpdatedCoordsValue($prop)
    {
        $val = $this->updatedCoords->{$prop};
        return $val;
    }


        /**
     * @param $prop
     * @param $val
     */
    private function setUpdatedCoordsValue($prop, $val)
    {
        $this->updatedCoords->{$prop} = $val;
    }

}
