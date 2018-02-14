<?php namespace App\Services;

use App\Controllers\Api\v1\UserController\ResponseMessageConstants;
use App\Decorators\UserRepositoryCacheDecorator;
use App\Entities\User;
use App\Repositories\UserRepository;
use ExtendedSlim\Database\Connection;
use Doctrine\DBAL\ConnectionException;
use Exception;
use ExtendedSlim\Exceptions\RecordNotFoundException;
use ExtendedSlim\Http\HttpCodeConstants;
use ExtendedSlim\Http\RestApiResponse;
use Monolog\Logger;

class UserService
{
    /** @var UserRepository */
    private $userRepository;

    /** @var Connection */
    private $connection;

    /** @var UserRepositoryCacheDecorator */
    private $userRepositoryCacheDecorator;

    /** @var Logger */
    private $logger;

    /**
     * @param UserRepository               $userRepository
     * @param UserRepositoryCacheDecorator $userRepositoryCacheDecorator
     * @param Connection                   $connection
     * @param Logger                       $logger
     */
    public function __construct(
        UserRepository $userRepository,
        UserRepositoryCacheDecorator $userRepositoryCacheDecorator,
        Connection $connection,
        Logger $logger
    )
    {
        $this->userRepository               = $userRepository;
        $this->connection                   = $connection;
        $this->userRepositoryCacheDecorator = $userRepositoryCacheDecorator;
        $this->logger                       = $logger;
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
    public function create(string $name): RestApiResponse
    {
        $this->connection->beginTransaction();

        try
        {
            $this->userRepository->create(new User(null, $name));
            $this->connection->commit();
            $this->logger->info('user create', ['name' => $name]);

            return new RestApiResponse();
        }
        catch (Exception $e)
        {
            $this->connection->rollBack();

            $this->logger->error('user create error', [
                'name'      => $name,
                'exception' => $e
            ]);

            return new RestApiResponse(
                null,
                ResponseMessageConstants::UNKNOWN_ERROR_ID,
                ResponseMessageConstants::UNKNOWN_ERROR_MESSAGE,
                HttpCodeConstants::BAD_REQUEST
            );
        }
    }
}
