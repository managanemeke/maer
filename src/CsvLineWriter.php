<?php

namespace Src;

class CsvLineWriter
{
    private string $outputFileName;
    private string $delimiter;

    private $file;

    public function __construct(
        string $outputFileName,
        string $delimiter
    ) {
        $this->outputFileName = $outputFileName;
        $this->delimiter = $delimiter;

        $this->file = fopen($this->outputFileName, 'w');
    }

    public function write(array $lines): void
    {
        foreach ($lines as $line) {
            fputcsv($this->file, $line, $this->delimiter);
        }

        fclose($this->file);
    }
}
