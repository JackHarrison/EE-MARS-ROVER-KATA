<?php

class Kata
{

    public array $directionValues = ['EAST' => 270, 'WEST' => 90, 'NORTH' => 360, 'SOUTH' => 180];
    private int $maxHeading = 360;
    private int $minHeading = 0;

    public object $initialCoords;
    public object $updatedCoords;


    public function getNewPosition($command)
    {
        $this->updatedCoords = $this->initialCoords;

        switch ($command) {
            case 'F':
                $this->changePositionalValueDependingOnDirection(1);
                break;
            case 'B':
                $this->changePositionalValueDependingOnDirection(-1);
                break;
            case 'L':

                if ($this->updatedCoords->heading == 90) {
                    $this->updatedCoords->heading = $this->maxHeading;
                } else {
                    $this->updatedCoords->heading -= 90;
                }

                $this->updatedCoords->direction = $this->changeDirectionStringDependingOnHeading();
                break;
            case 'R':

                if ($this->updatedCoords->heading == $this->maxHeading) {
                    $this->updatedCoords->heading = $this->minHeading;
                }

                $this->updatedCoords->heading += 90;
                $this->updatedCoords->direction = $this->changeDirectionStringDependingOnHeading();
                break;
        }
    }


    private function changePositionalValueDependingOnDirection($value)
    {

        switch ($this->updatedCoords->direction) {
            case 'WEST':
            case 'EAST':
            $this->updatedCoords->x += $value;
                break;
            case 'NORTH':
            case 'SOUTH':
            $this->updatedCoords->y += $value;
                break;
        }
    }


    private function changeDirectionStringDependingOnHeading()
    {
        return array_search($this->updatedCoords->heading, $this->directionValues);
    }


}
