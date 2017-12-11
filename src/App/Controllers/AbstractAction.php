<?php namespace App\Controllers;

use ExtendedSlim\Http\ErrorResponseItem;
use Symfony\Component\Validator\ConstraintViolation;

class AbstractAction
{
    /**
     * @param $violations
     *
     * @return array
     */
    public function createErrorResponse($violations): array
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