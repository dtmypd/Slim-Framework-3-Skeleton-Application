<?php namespace App\Services;

use App\Controllers\Api\v1\UserController\ResponseMessageConstants;
use App\Entities\User;
use App\Repositories\UserRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ConnectionException;
use Exception;
use ExtendedSlim\Http\HttpCodeConstants;
use ExtendedSlim\Http\RestApiResponse;

class UserService
{
    /** @var UserRepository */
    private $userRepository;

    /** @var Connection */
    private $connection;

    /**
     * @param UserRepository $userRepository
     * @param Connection     $connection
     */
    public function __construct(UserRepository $userRepository, Connection $connection)
    {
        $this->userRepository = $userRepository;
        $this->connection     = $connection;
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
