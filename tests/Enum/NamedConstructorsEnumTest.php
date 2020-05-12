<?php

namespace Slepic\Tests\ValueObject\Enum;

use PHPUnit\Framework\TestCase;
use Slepic\ValueObject\Strings\StringValueExceptionInterface;

class NamedConstructorsEnumTest extends TestCase
{
    public function testNamedConstructor(): void
    {
        $value1 = NamedConstructorsEnumFixture::value1();
        self::assertInstanceOf(NamedConstructorsEnumFixture::class, $value1);
        self::assertSame('value1', (string) $value1);

        $value2 = NamedConstructorsEnumFixture::value2();
        self::assertInstanceOf(NamedConstructorsEnumFixture::class, $value2);
        self::assertSame('value2', (string) $value2);
    }

    public function testUniqueInstances(): void
    {
        self::assertSame(
            NamedConstructorsEnumFixture::value1(),
            NamedConstructorsEnumFixture::value1()
        );

        self::assertSame(
            NamedConstructorsEnumFixture::value2(),
            NamedConstructorsEnumFixture::value2()
        );
    }

    public function testGetAll(): void
    {
        $all = NamedConstructorsEnumFixture::all();
        self::assertCount(2, $all);
        self::assertArrayHasKey('value1', $all);
        self::assertSame(NamedConstructorsEnumFixture::value1(), $all['value1']);
        self::assertArrayHasKey('value2', $all);
        self::assertSame(NamedConstructorsEnumFixture::value2(), $all['value2']);
    }

    public function testFromString(): void
    {
        self::assertSame(
            NamedConstructorsEnumFixture::value1(),
            NamedConstructorsEnumFixture::fromString('value1')
        );

        self::assertSame(
            NamedConstructorsEnumFixture::value2(),
            NamedConstructorsEnumFixture::fromString('value2')
        );

        try {
            NamedConstructorsEnumFixture::fromString('invalid');
            self::assertTrue(false, 'StringValueExceptionInterface not thrown');
        } catch (StringValueExceptionInterface $e) {
            self::assertSame('invalid', $e->getValue());
            self::assertStringContainsString('value1', $e->getExpectation());
            self::assertStringContainsString('value2', $e->getExpectation());
        }
    }
}
