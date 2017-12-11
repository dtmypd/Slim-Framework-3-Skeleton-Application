<?php namespace ExtendedSlim\Factories;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\RecursiveValidator;

class ValidatorFactory
{
    /**
     * @return RecursiveValidator
     */
    public function create()
    {
        return Validation
            ::createValidatorBuilder()
            ->addMethodMapping('loadValidatorMetadata')
            ->getValidator();
    }
}
