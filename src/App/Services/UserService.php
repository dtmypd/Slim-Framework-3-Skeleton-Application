<?php namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    /** @var UserRepository */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $name
     */
    public function create(string $name)
    {
        $this->userRepository->create($name);
    }
}
