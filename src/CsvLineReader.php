<?php

namespace Src;

use Generator;

class CsvLineReader
{
    private string $inputFileName;
    private string $delimiter;

    private $file;

    public function __construct(
        string $inputFileName,
        string $delimiter
    ) {
        $this->inputFileName = $inputFileName;
        $this->delimiter = $delimiter;

        $this->file = fopen($this->inputFileName, 'r');
    }

    public function read(): Generator
    {
        while (
            ($line = fgetcsv($this->file, null, $this->delimiter)) !== false
        ) {
            yield $line;
        }

        fclose($this->file);
    }
}
