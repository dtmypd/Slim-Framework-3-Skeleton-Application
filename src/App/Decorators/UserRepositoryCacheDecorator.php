<?php namespace App\Decorators;

use App\Entities\User;
use App\Repositories\UserRepository;
use ExtendedSlim\Exceptions\RecordNotFoundException;
use Memcached;

class UserRepositoryCacheDecorator
{
    /** @var UserRepository */
    private $userRepository;

    /** @var Memcached */
    private $memcached;

    /**
     * @param UserRepository $userRepository
     * @param Memcached      $memcached
     */
    public function __construct(UserRepository $userRepository, Memcached $memcached)
    {
        $this->userRepository = $userRepository;
        $this->memcached      = $memcached;
    }

    /**
     * @param string $name
     *
     * @return User
     * @throws RecordNotFoundException
     */
    public function findByName(string $name)
    {
        $key = __METHOD__ . '/' . $name;

        $user = $this->memcached->get($key);
        if (false === $user)
        {
            $user = $this->userRepository->findByName($name);

            $this->memcached->set($key, $user, 10);
        }

        return $user;
    }
}
