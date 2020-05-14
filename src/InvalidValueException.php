<?php declare(strict_types=1);

namespace Slepic\ValueObject;

class InvalidValueException extends \InvalidArgumentException implements InvalidValueExceptionInterface
{
    /**
     * @var mixed
     */
    private $value;

    private ?string $expectation;

    /**
     * @param mixed $value
     * @param string|null $expectation
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(
        $value,
        ?string $expectation,
        string $message = "",
        int $code = 0,
        \Throwable $previous = null
    ) {
        if (\is_object($value) && !\method_exists($value, '__toString')) {
            $serializedValue = 'object';
        } else {
            $serializedValue = (string) $value;
        }
        if (!$message) {
            if ($expectation !== null) {
                $message = "Expected $expectation got \"$serializedValue\".";
            } else {
                $message = "\"$serializedValue\" not expected.";
            }
        }
        $this->value = $value;
        $this->expectation = $expectation;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    final public function getExpectation(): ?string
    {
        return $this->expectation;
    }
}
