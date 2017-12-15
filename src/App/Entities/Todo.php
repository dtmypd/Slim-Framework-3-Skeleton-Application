<?php namespace App\Entities;

use JsonSerializable;

class Todo implements JsonSerializable
{
    /** @var int|null */
    private $id;

    /** @var string */
    private $name;

    /** @var int */
    private $userId;

    /**
     * @param int|null $id
     * @param string   $name
     * @param int      $userId
     */
    public function __construct(?int $id, string $name, int $userId)
    {
        $this->id     = $id;
        $this->name   = $name;
        $this->userId = $userId;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
        return $this->userId;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'     => $this->getId(),
            'name'   => $this->getName(),
            'userId' => $this->getUserId(),
        ];
    }
}
