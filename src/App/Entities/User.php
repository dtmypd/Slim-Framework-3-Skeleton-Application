<?php namespace App\Entities;

use JsonSerializable;

class User implements JsonSerializable
{
    /** @var int|null */
    private $id;

    /** @var string */
    private $userName;

    /**
     * @param int|null $id
     * @param string   $userName
     */
    public function __construct(?int $id, string $userName)
    {
        $this->id       = $id;
        $this->userName = $userName;
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
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id'   => $this->getId(),
            'name' => $this->getUserName(),
        ];
    }
}
