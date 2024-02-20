# trebuchet

Trebuchet is a PHP application based on Advent of Code Day 1 designed to recover calibration values from an input file:

calibrationDocument.txt

It consists of two main components:

1) CalibrationDocument: Responsible for reading input lines from a document.
2) CalibrationValue: Responsible for recovering calibration values from input lines.

Unit Testing: Includes comprehensive unit tests for both classes.

Requirements
1) PHP 8.1 or higher
2) PHPUnit for running unit tests (install with composer, files included)

Usage
1) Run the main script main.php from the root directory (Part 1):

php main.php

2) Optionally, you can include spelled out digits in the recovery process (Part 2):

php main.php --include-spelled-out

Unit Testing

To run unit tests for both classes, execute the following command:

phpunit tests