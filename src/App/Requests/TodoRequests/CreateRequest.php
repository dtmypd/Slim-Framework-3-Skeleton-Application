<?php namespace App\Requests\TodoRequests;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class CreateRequest
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $userId;

    /**
     * @param string $name
     * @param string $userId
     */
    public function __construct(string $name, string $userId)
    {
        $this->name   = $name;
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return (int)$this->userId;
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
