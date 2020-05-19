<?php declare(strict_types=1);

namespace Slepic\ValueObject\Integers;

use Slepic\ValueObject\ViolationException;
use Slepic\ValueObject\ViolationExceptionInterface;

final class IntegerTooSmall implements IntegerViolationInterface
{
    private int $lowerBound;

    public function __construct(int $lowerBound)
    {
        $this->lowerBound = $lowerBound;
    }

    public function getLowerBound(): int
    {
        return $this->lowerBound;
    }

    public static function exception(int $lowerBound): ViolationExceptionInterface
    {
        return new ViolationException([new self($lowerBound)]);
    }
}