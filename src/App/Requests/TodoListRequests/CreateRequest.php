<?php namespace App\Requests\TodoListRequests;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class CreateRequest
{
    /** @var string */
    protected $name;

    /** @var int|null */
    protected $userId;

    /**
     * @param string   $name
     * @param int|null $userId
     */
    public function __construct(string $name, int $userId)
    {
        $this->name   = $name;
        $this->userId = $userId;
    }

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
        $metadata->addPropertyConstraint('name', new Length(['min' => 5, 'max' => 20]));
        $metadata->addPropertyConstraint('userId', new NotBlank());
        $metadata->addPropertyConstraint('userId', new Type('integer'));
    }
}
