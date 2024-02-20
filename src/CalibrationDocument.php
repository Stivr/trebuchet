<?php

declare(strict_types=1);

require 'DocumentReaderInterface.php';

/**
 * Represents a document reader for CalibrationDocument objects.
 *
 * This class implements the DocumentReaderInterface and provides functionality to read calibration
 * documents line by line.
 *
 * @author Stephen Rostanti
 * @version 1.0
 */
class CalibrationDocument implements DocumentReaderInterface
{
    /** @var string The file path of the calibration document. */
    private string $filePath;

    /**
     * Constructs a new CalibrationDocument instance.
     *
     * @param string $filePath The file path of the calibration document.
     * @throws InvalidArgumentException If the file does not exist or is not readable.
     */
    public function __construct($filePath)
    {
        // Throws error if the file does not exist or is not readable.
        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new InvalidArgumentException("File does not exist or is not readable: $filePath");
        }
        $this->filePath = $filePath;
    }

    /**
     * Reads lines from the calibration document.
     *
     * Opens the calibration document file for reading, reads each line, and yields it.
     * The method removes trailing newline characters from each line.
     *
     * @return Generator Yields each line from the calibration document.
     * @throws RuntimeException If failed to open the document for reading.
     */
    public function readLines(): Generator
    {
        // Opens the file for reading.
        $file = fopen($this->filePath, 'r');
        if (!$file) {
            throw new RuntimeException("Failed to open document: {$this->filePath}");
        }

        // Reads line by line.
        while (($line = fgets($file)) !== false) {
            // Yields the line
            yield rtrim($line, "\r\n");
        }

        // Closes the file after reading.
        fclose($file);
    }
}
