<?php declare(strict_types=1);

namespace Slepic\ValueObject;

interface FromFloatConstructableInterface
{
    public static function fromFloat(float $value): self;
}
