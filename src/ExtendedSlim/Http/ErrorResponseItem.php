<?php namespace ExtendedSlim\Http;

use JsonSerializable;
use Symfony\Component\Validator\Constraint;

class ErrorResponseItem implements JsonSerializable
{
    /** @var string */
    private $message;

    /** @var array */
    private $parameters;

    /** @var Constraint|null */
    private $constraint;

    /** @var string|null */
    private $propertyPath;

    /**
     * @param string          $message
     * @param array           $parameters
     * @param Constraint|null $constraint
     * @param string|null     $propertyPath
     */
    public function __construct(string $message, array $parameters, $constraint, string $propertyPath)
    {
        $this->message      = $message;
        $this->parameters   = $parameters;
        $this->constraint   = $constraint;
        $this->propertyPath = $propertyPath;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'message'      => $this->message,
            'parameters'   => $this->parameters,
            'constraint'   => $this->constraint,
            'propertyPath' => $this->propertyPath
        ];
    }
}