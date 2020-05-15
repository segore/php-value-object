<?php declare(strict_types=1);

namespace Slepic\ValueObject;

interface FromArrayConstructableInterface
{
    public static function fromArray(array $value): self;
}
