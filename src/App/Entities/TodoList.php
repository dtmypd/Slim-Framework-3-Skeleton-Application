<?php namespace App\Entities;

use JsonSerializable;

class TodoList implements JsonSerializable
{
    /** @var integer */
    private $id;

    /** @var string */
    private $name;

    /**
     * @param int    $id
     * @param string $name
     */
    public function __construct(int $id, string $name)
    {
        $this->id   = $id;
        $this->name = $name;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id'   => $this->getId(),
            'name' => $this->getName(),
        ];
    }
}