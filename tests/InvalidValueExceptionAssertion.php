<?php declare(strict_types=1);

namespace Slepic\Tests\ValueObject;

use PHPUnit\Framework\TestCase;
use Slepic\ValueObject\InvalidValueExceptionInterface;

class InvalidValueExceptionAssertion
{
    public static function assert(
        InvalidValueExceptionInterface $e,
        $value,
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
        array $messageSubstrings = []
    ): void {
        TestCase::assertSame($value, $e->getValue());
        TestCase::assertSame($code, $e->getCode());
        TestCase::assertSame($previous, $e->getPrevious());
        if ($message) {
            TestCase::assertSame($message, $e->getMessage());
        } else {
            foreach ($messageSubstrings as $substring) {
                TestCase::assertStringContainsString($substring, $e->getMessage());
            }
        }
    }
}
