<?php namespace App\ParameterObjects;

class PagerParameterObject
{
    /** @var int */
    private $limit;

    /** @var int */
    private $offset;

    /**
     * @param int $limit
     * @param int $offset
     */
    public function __construct(int $limit, int $offset)
    {
        $this->limit  = $limit;
        $this->offset = $offset;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }
}
