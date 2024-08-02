<?php

namespace Src;

class ScratchPoint
{
    private int $number;
    private int $globalAddressAmount = 0;
    private int $localAddressAmount = 0;
    private int $relevantAddressAmount = 0;
    private int $irrelevantAddressAmount = 0;

    public function __construct(int $number) {
        $this->number = $number;
    }

    public function number(): int
    {
        return $this->number;
    }

    public function globalAddressAmount(): int
    {
        return $this->globalAddressAmount;
    }

    public function localAddressAmount(): int
    {
        return $this->localAddressAmount;
    }

    public function relevantAddressAmount(): int
    {
        return $this->relevantAddressAmount;
    }

    public function irrelevantAddressAmount(): int
    {
        return $this->irrelevantAddressAmount;
    }

    public function addMacAddress(MacAddress $macAddress): void
    {
        if ($macAddress->isGlobal()) {
            $this->globalAddressAmount += 1;
        } else {
            $this->localAddressAmount += 1;
        }

        if ($macAddress->isRelevant()) {
            $this->relevantAddressAmount += 1;
        } else {
            $this->irrelevantAddressAmount += 1;
        }
    }
}
