<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/CalibrationValue.php';


/**
 * Unit tests for the CalibrationValue class.
 */
class CalibrationValueTest extends TestCase
{
    /** @var CalibrationValue The instance of CalibrationValue for testing. */
    private CalibrationValue $calibrationValue;

    /**
     * Sets up the test fixture.
     */
    public function setUp(): void
    {
        $this->calibrationValue = new CalibrationValue();
    }

    /**
     * Tests the recoverValue() function excluding spelled out digits.
     */
    public function testRecoverValueExcludingSpelledOutDigits(): void
    {
        // Example input strings and their expected outputs
        $testCases = [

            // Structured Inputs
            ["5", 55], // Single Digit
            ["12", 12], // Two Digits
            ["321", 31], // Three Digits
            ["one", 0], // Single Spelled Out Digit
            ["onetwo", 0], // Two Spelled Out Digits
            ["threetwoone", 0], // Three Spelled Out Digits
            ["468threeeight897nine", 47], // Mix of Digits and Spelled Out Digits
            ["468threeeight897nine739", 49], // Digits at Beginning and End
            ["seven468threeeight897nine", 47], // Spelled Out Digits at Beginning and End
            ["666666666", 66], // Repeated Digits
            ["nineninenineninenineninenine", 0], // Repeated Spelled Out Digits
            ["", 0], // Empty

            // Random Inputs
            ["two1nine", 11],
            ["eightwothree", 0],
            ["abcone2threexyz", 22],
            ["xtwone3four", 33],
            ["4nineeightseven2", 42],
            ["zoneight234", 24],
            ["7pqrstsixteen", 77],
            ["4fiveqvmd8157", 47],
            ["1sevennine8793kxkx2", 12],
            ["sixrbr6ninemdmsmjrchbvhvpmmsfphtslll3", 63],
            ["one2qcrqhbqnine", 22],
            ["rmrbtgfkd2cbzpggbp6", 26],
            ["797fbxjbb", 77],
            ["fiveonevsv2four28", 28],
            ["six9sevensix", 99],
            ["7nxztt", 77],
            ["three3vcqrjgjndsbxpvclvg2vsv3", 33]
        ];

        // Iterate through test cases
        foreach ($testCases as $testCase) {
            [$input, $expectedOutput] = $testCase;
            $this->assertEquals($expectedOutput, $this->calibrationValue->recoverValue($input));
        }
    }

    /**
     * Tests the recoverValue() function including spelled out digits.
     */
    public function testRecoverValueIncludingSpelledOutDigits(): void
    {
        // Example input strings and their expected outputs
        $testCases = [

            // Structured Inputs
            ["5", 55], // Single Digit
            ["12", 12], // Two Digits
            ["321", 31], // Three Digits
            ["one", 11], // Single Spelled Out Digit
            ["onetwo", 12], // Two Spelled Out Digits
            ["threetwoone", 31], // Three Spelled Out Digits
            ["468threeeight897nine", 49], // Mix of Digits and Spelled Out Digits
            ["468threeeight897nine739", 49], // Digits at Beginning and End
            ["seven468threeeight897nine", 79], // Spelled Out Digits at Beginning and End
            ["666666666", 66], // Repeated Digits
            ["nineninenineninenineninenine", 99], // Repeated Spelled Out Digits
            ["", 0], // Empty

            // Random Inputs
            ["two1nine", 29],
            ["eightwothree", 83],
            ["abcone2threexyz", 13],
            ["xtwone3four", 24],
            ["4nineeightseven2", 42],
            ["zoneight234", 14],
            ["7pqrstsixteen", 76],
            ["4fiveqvmd8157", 47],
            ["1sevennine8793kxkx2", 12],
            ["sixrbr6ninemdmsmjrchbvhvpmmsfphtslll3", 63],
            ["one2qcrqhbqnine", 19],
            ["rmrbtgfkd2cbzpggbp6", 26],
            ["797fbxjbb", 77],
            ["fiveonevsv2four28", 58],
            ["six9sevensix", 66],
            ["7nxztt", 77],
            ["three3vcqrjgjndsbxpvclvg2vsv3", 33]
        ];

        // Iterate through test cases
        foreach ($testCases as $testCase) {
            [$input, $expectedOutput] = $testCase;
            $this->assertEquals($expectedOutput, $this->calibrationValue->recoverValue($input, true));
        }
    }
}
