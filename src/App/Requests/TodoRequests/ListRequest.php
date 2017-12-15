<?php namespace App\Requests\TodoRequests;

use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class ListRequest
{
    /** @var string */
    protected $page;

    /**
     * @param string $page
     */
    public function __construct(string $page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return (int)$this->page;
    }

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('page', new NotBlank());
        $metadata->addPropertyConstraint('page', new Regex(['pattern' => '/^\d+$/']));
    }
}
