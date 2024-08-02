<?php

namespace Src;

class MacAddress
{
    private const BYTE_SIZE = 8;
    private const BYTE_AMOUNT = 6;

    private string $binary;

    public function __construct(int $macAddress)
    {
        $this->binary = str_pad(
            decbin($macAddress),
            self::BYTE_AMOUNT * self::BYTE_SIZE,
            "0",
            STR_PAD_LEFT
        );
    }

    public function binary(): string
    {
        return $this->binary;
    }

    public function integer(): int
    {
        return bindec($this->binary);
    }

    public function bit(int $number): bool
    {
        return $this->binary[$number - 1] === "1";
    }

    public function byte(int $number): int
    {
        return
            bindec(
                implode(
                    '',
                    array_slice(
                        str_split($this->binary),
                        ($number - 1) * self::BYTE_SIZE,
                        self::BYTE_SIZE
                    )
                )
            );
    }

    public function isGlobal(): bool
    {
        return !$this->bit(7);
    }

    public function isRelevant(): bool
    {
        if (
            !$this->isGlobal()
            || (
                $this->bit(1)
                &&
                $this->byte(6) >= 200
            )
            || (
                !$this->bit(1)
                &&
                $this->byte(6) <= 127
            )
        ) {
            return true;
        } else {
            return false;
        }
    }
}
