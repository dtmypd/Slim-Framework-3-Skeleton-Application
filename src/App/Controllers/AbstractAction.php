<?php namespace App\Controllers;

use ExtendedSlim\Http\ErrorResponseItem;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\RecursiveValidator;

class AbstractAction
{
    /**
     * @return RecursiveValidator
     */
    public function getValidator()
    {
        return Validation
            ::createValidatorBuilder()
            ->addMethodMapping('loadValidatorMetadata')
            ->getValidator();
    }

    /**
     * @param $violations
     *
     * @return array
     */
    public function createErrorResponse($violations)
    {
        $messages = [];
        /** @var ConstraintViolation $violation */
        foreach ($violations as $violation)
        {
            $messages[$violation->getPropertyPath()][] = new ErrorResponseItem(
                $violation->getMessage(),
                $violation->getParameters(),
                $violation->getConstraint(),
                $violation->getPropertyPath()
            );
        }

        return $messages;
    }
}