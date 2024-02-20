<?php

declare(strict_types=1);

/**
 * Represents a CalibrationValue object responsible for recovering calibration values from input lines.
 *
 * @author Stephen Rostanti
 * @version 1.0
 */
class CalibrationValue
{
    private const SPELLED_OUT_DIGITS = [
        'one'   => 1,
        'two'   => 2,
        'three' => 3,
        'four'  => 4,
        'five'  => 5,
        'six'   => 6,
        'seven' => 7,
        'eight' => 8,
        'nine'  => 9
    ];

    /**
     * Recovers the calibration value from the line.
     *
     * @param string $line The input string from which to recover the calibration value.
     * @param bool $includeSpelledOutDigits Whether to include spelled out digits when recovering the value.
     * @return int The calibration value
     */
    public function recoverValue(string $line, bool $includeSpelledOutDigits = false): int
    {
        // Find digits and their positions in the input line
        $matches = $this->findDigits($line);

        // Optionally replace spelled out digits with their numeric values
        if ($includeSpelledOutDigits) {
            $this->replaceSpelledOutDigits($line, $matches);
        }

        // If no digits are found early exit with return 0
        if (empty($matches)) {
            return 0;
        }

        // Concatenate the first and last digits to recover the calibration value
        return $this->concatenateDigits($matches);
    }

    /**
     * Finds all digits and their respective position in the line.
     *
     * @param string $line The input string to search for digits.
     * @return array The matches and their position in the line
     */
    private function findDigits(string $line): array
    {
        // Array to store the digits and their respective positions found in the input line
        $matches = [];
        for ($i = 0; $i < strlen($line); $i++) {
            $character = $line[$i];
            // Check if the character is a digit (1-9)
            if ($character > '0' && $character <= '9') {
                // If it's a digit, add its value to the matches array
                $matches[$i] = intval($character);
            }
        }
        return $matches;
    }

    /**
     * Replaces all spelled out digits with their numeric value.
     *
     * @param string &$line The input string to search for spelled out digits.
     * @param array &$matches An array of digits and their respective positions found in the input string.
     * @return void
     * @return void
     */
    private function replaceSpelledOutDigits(string &$line, array &$matches): void
    {
        // Iterate through each spelled out digit and replace occurrences in the line with their numeric values
        foreach (self::SPELLED_OUT_DIGITS as $spelledOutDigit => $digit) {
            // Find the first occurrence of the spelled out digit in the line
            $position = strpos($line, $spelledOutDigit);
            while ($position !== false) {
                // Replace the spelled-out digit with its numeric value in the matches array
                $matches[$position] = $digit;
                // Find the next occurrence of the spelled out digit in the line
                $position = strpos($line, $spelledOutDigit, $position + 1);
            }
        }
    }

    /**
     * Concatenates the first and last digits found in the input array.
     *
     * @param array $matches An array of digits and their respective positions found in the input string.
     * @return int The concatenated value of the first and last digits.
     */
    private function concatenateDigits(array $matches): int
    {
        // Find the lowest and highest indices in the matches array
        $lowestIndex = min(array_keys($matches));
        $highestIndex = max(array_keys($matches));

        // Get the values of the first and last digits found in the array
        $firstDigit = $matches[$lowestIndex];
        $lastDigit = $matches[$highestIndex];

        // Concatenate the first and last digits and return the result
        return $firstDigit * 10 + $lastDigit;
    }
}
