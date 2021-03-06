<?php declare(strict_types=1);

namespace Slepic\Tests\ValueObject;

use PHPUnit\Framework\TestCase;
use Slepic\ValueObject\InvalidTypeException;
use Slepic\ValueObject\InvalidTypeExceptionInterface;

final class InvalidTypeExceptionTest extends TestCase
{
    /**
     * @param $value
     * @param string|null $expectation
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     * @param array $messageSubstrings
     *
     * @dataProvider provideConstructorTestData
     */
    public function testConstructor(
        $value,
        ?string $expectation = null,
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
        array $messageSubstrings = []
    ): void {
        $e = new InvalidTypeException($value, $expectation, $message, $code, $previous);

        self::assertInstanceOf(InvalidTypeExceptionInterface::class, $e);
        InvalidValueExceptionAssertion::assert(
            $e,
            $value,
            $expectation,
            $message,
            $code,
            $previous,
            $messageSubstrings
        );
    }

    public function provideConstructorTestData(): array
    {
        return [
            [1],
            [''],
            [10.0],
            ['hello', 'exp', 'custom message'],
            [
                'abscdef0123',
                null,
                '',
                0,
                new \Exception('test'),
                ['"string" not expected']
            ],
            [
                'abscdef0123',
                'gulligulli',
                '',
                15,
                new \Exception('test'),
                ['Expected "gulligulli"', 'got "string"']
            ],
        ];
    }
}
