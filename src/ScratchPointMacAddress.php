<?php

namespace Src;

class ScratchPointMacAddress
{
    private int $number;
    private MacAddress $macAddress;

    public function __construct(
        string $number,
        string $macAddress
    ) {
        $this->number = (int)$number;
        $this->macAddress = new MacAddress((int)$macAddress);
    }

    public function number(): int
    {
        return $this->number;
    }

    public function macAddress(): MacAddress
    {
        return $this->macAddress;
    }
}
