<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/CalibrationDocument.php';

/**
 * Unit tests for the CalibrationDocument class.
 */
class CalibrationDocumentTest extends TestCase
{
    /**
     * Tests the readLines method when lines are found in the document.
     */
    public function testReadLinesWhenFound(): void
    {
        $filePath = 'calibrationDocument.txt';
        $document = new CalibrationDocument($filePath);
        $lines = $document->readLines();

        // Initialise an array to store the lines
        $actualLines = [];

        // Iterate over the generator to extract the lines
        foreach ($lines as $line) {
            $actualLines[] = $line;
        }

        // Perform assertions on the extracted lines
        $this->assertNotEmpty($actualLines);

        $this->assertEquals("1six7396484", $actualLines[0]);
        $this->assertEquals("1ninehgqtjprgnpkchxdkctzk", $actualLines[1]);
        $this->assertEquals("sevenmpsmstdfivebtnjljnlnpjrkhhsninefour9", $actualLines[2]);
        // Add more assertions as needed for other lines
    }

    /**
     * Tests the readLines method when the file does not exist.
     */
    public function testReadLinesWhenFileDoesNotExist(): void
    {
        $filePath = 'File.txt';

        // Expects an InvalidArgumentException with a specific message when the file does not exist
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("File does not exist or is not readable: $filePath");

        // Attempts to create a CalibrationDocument instance with a non existent file
        $document = new CalibrationDocument($filePath);
    }

    /**
     * Tests the readLines method when the file is empty.
     */
    public function testReadLinesWhenFileIsEmpty(): void
    {
        $filePath = 'emptyDocument.txt';

        // Attempt to read lines from the empty file
        $document = new CalibrationDocument($filePath);
        $lines = $document->readLines();

        // Assert that no lines are returned
        $this->assertEmpty(iterator_to_array($lines));
    }
}
