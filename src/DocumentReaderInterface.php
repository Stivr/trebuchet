<?php

/**
 * Interface DocumentReaderInterface
 *
 * Represents an interface for reading lines from a document.
 */
interface DocumentReaderInterface
{
    /**
     * Reads lines from the document.
     *
     * @return Generator A generator that yields each line from the document.
     */
    public function readLines(): Generator;
}
