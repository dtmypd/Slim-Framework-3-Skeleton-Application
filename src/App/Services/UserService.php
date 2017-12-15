<?php namespace App\Services;

use App\Controllers\Api\v1\UserController\ResponseMessageConstants;
use App\Decorators\UserRepositoryCacheDecorator;
use App\Entities\User;
use App\Repositories\UserRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ConnectionException;
use Exception;
use ExtendedSlim\Exceptions\RecordNotFoundException;
use ExtendedSlim\Http\HttpCodeConstants;
use ExtendedSlim\Http\RestApiResponse;

class UserService
{
    /** @var UserRepository */
    private $userRepository;

    /** @var Connection */
    private $connection;

    /** @var UserRepositoryCacheDecorator */
    private $userRepositoryCacheDecorator;

    /**
     * @param UserRepository               $userRepository
     * @param UserRepositoryCacheDecorator $userRepositoryCacheDecorator
     * @param Connection                   $connection
     */
    public function __construct(
        UserRepository $userRepository,
        UserRepositoryCacheDecorator $userRepositoryCacheDecorator,
        Connection $connection
    ) {
        $this->userRepository               = $userRepository;
        $this->connection                   = $connection;
        $this->userRepositoryCacheDecorator = $userRepositoryCacheDecorator;
    }

    /**
     * @param string $name
     *
     * @return User
     * @throws RecordNotFoundException
     */
    public function findByName(string $name)
    {
        return $this->userRepositoryCacheDecorator->findByName($name);
    }

    /**
     * @param string $name
     *
     * @return RestApiResponse
     * @throws ConnectionException
     */
    public function create(string $name)
    {
        $this->connection->beginTransaction();

        try
        {
            $this->userRepository->create(new User(null, $name));

            $this->connection->commit();

            return new RestApiResponse();
        }
        catch (Exception $e)
        {
            $this->connection->rollBack();

            return new RestApiResponse(
                null,
                ResponseMessageConstants::UNKNOWN_ERROR_ID,
                ResponseMessageConstants::UNKNOWN_ERROR_MESSAGE,
                HttpCodeConstants::BAD_REQUEST
            );
        }
    }
}
