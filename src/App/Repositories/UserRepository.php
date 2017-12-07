<?php namespace App\Repositories;

use App\Entities\User;
use ExtendedSlim\Exceptions\RecordNotFoundException;
use PDO;

class UserRepository extends AbstractRepository
{
    /**
     * @param string $name
     */
    public function create(string $name)
    {
        $this->getConnection()->insert(UserTable::TABLE_NAME, [UserTable::FIELD_USER_NAME => $name]);
    }

    /**
     * @param string $name
     *
     * @return User
     * @throws RecordNotFoundException
     */
    public function findByName(string $name): User
    {
        $qB  = $this->createQueryBuilder();
        $row = $qB
            ->select(1)
            ->from(UserTable::TABLE_NAME)
            ->where(UserTable::FIELD_USER_NAME . ' = ' . $qB->createNamedParameter($name))
            ->execute()
            ->fetchAll(PDO::FETCH_ASSOC);

        if (null === $row)
        {
            throw new RecordNotFoundException();
        }

        return $this->buildEntity($row);
    }

    /**
     * @param $row
     *
     * @return User
     */
    private function buildEntity($row): User
    {
        return new User($row[UserTable::FIELD_ID], $row[UserTable::FIELD_USER_NAME]);
    }
}
