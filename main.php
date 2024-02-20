<?php

declare(strict_types=1);

require_once __DIR__ . '/src/CalibrationDocument.php';
require_once __DIR__ .  '/src/CalibrationValue.php';

// Check if an optional parameter is provided for including spelled out digits.
$includeSpelledOut = false;
if (isset($argv[1]) && $argv[1] === '--include-spelled-out') {
    $includeSpelledOut = true;
}

try {
    // Create an instance of CalibrationDocument to read the calibration document.
    $calibrationDocument = new CalibrationDocument('calibrationDocument.txt');

    // Create an instance of CalibrationValue to recover calibration values.
    $calibrationValue = new CalibrationValue();

    // Initialize the total sum of calibration values.
    $totalSum = 0;

    // Iterate over each line in the calibration document.
    foreach ($calibrationDocument->readLines() as $line) {
        // Recover the calibration value from the line and add it to the total sum.
        $totalSum += $calibrationValue->recoverValue($line, $includeSpelledOut);
    }

    // Output the total sum of calibration values.
    echo "The sum of all calibration values is: $totalSum. \n";
} catch (Exception $e) {
    // Handle any exceptions and output error message.
    echo "Error: " . $e->getMessage() . "\n";
}
