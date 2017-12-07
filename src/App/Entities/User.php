<?php namespace App\Entities;

use JsonSerializable;

class User implements JsonSerializable
{
    /** @var integer */
    private $id;

    /** @var string */
    private $userName;

    /**
     * @param int    $id
     * @param string $userName
     */
    public function __construct(int $id, string $userName)
    {
        $this->id       = $id;
        $this->userName = $userName;
    }

    /**
     * @return int
     */
    public function getId(): int
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
