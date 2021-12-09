# EE-MARS-ROVER-KATA
[![standard-readme compliant](https://img.shields.io/badge/readme%20style-standard-brightgreen.svg?style=flat-square)](https://github.com/JackHarrison/EE-MARS-ROVER-KATA)

## Execution<br>
Run on a webserver with query string of commands<br>

e.g.<br>
To simulate movement of the Mars rover with the following commands LEFT, RIGHT, BACK, FORWARD:<br>

http://localhost/EE-MARS-ROVER-KATA/index.php?directions=LRBF

***

## Accepted commands:
* F  = forward
* B = backwards
* L = left
* R = right

Unhanded string commands are captured and reported in the interface.

***

## Requirements 

* PHP 5.6 > 7.4
* Apache

***

## Results

If the command is within the accepted list of available commands, the application will print the results 
and show the Rover's current updated position and heading/direction.

***

## Code Structure

The application performs a foreach loop over the array of commands and then calls a method called **getNewPosition** with the commabd as an argument.

Within the method **getNewPosition** there are calls to two other methods, **changePositionalValueDependingOnDirection** 
& **changeDirectionStringDependingOnHeading**.<br><br>Some simple logic updates the **updatedCoords** which is an object with properties for 
x position, y position, direction and heading.

***



Version: 1.4, Last updated: 2021-12-09

