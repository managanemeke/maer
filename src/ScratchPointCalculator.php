<?php

namespace Src;

class ScratchPointCalculator
{
    private string $inputFileName;
    private string $outputFileName;
    private string $delimiter;

    /** @var ScratchPoint[] */
    private array $scratchPoints = [];

    public function __construct(
        string $inputFileName,
        string $outputFileName,
        string $delimiter
    ) {
        $this->inputFileName = $inputFileName;
        $this->outputFileName = $outputFileName;
        $this->delimiter = $delimiter;
    }

    public function calculate(): void
    {
        $reader = new CsvLineReader($this->inputFileName, $this->delimiter);
        foreach ($reader->read() as $line) {
            $this->handleScratchPointMacAddress(new ScratchPointMacAddress($line[0], $line[1]));
        }
        $this->write();
    }

    private function handleScratchPointMacAddress(ScratchPointMacAddress $scratchPointMacAddress): void
    {
        $scratchPoints = $this->scratchPoints;
        $number = $scratchPointMacAddress->number();
        if (isset($scratchPoints[$number])) {
            $scratchPoint = $scratchPoints[$number];
        } else {
            $scratchPoint = new ScratchPoint($number);
            $this->scratchPoints[$number] = $scratchPoint;
        }
        $scratchPoint->addMacAddress($scratchPointMacAddress->macAddress());
    }

    private function write(): void
    {
        $writer = new CsvLineWriter($this->outputFileName, $this->delimiter);
        $writer->write($this->lines());
    }

    private function lines(): array
    {
        $lines = [];
        foreach ($this->scratchPoints as $scratchPoint) {
            $lines[] = [
                $scratchPoint->number(),
                $scratchPoint->globalAddressAmount(),
                $scratchPoint->localAddressAmount(),
                $scratchPoint->relevantAddressAmount(),
                $scratchPoint->irrelevantAddressAmount(),
            ];
        }
        ksort($lines);
        return $lines;
    }
}
