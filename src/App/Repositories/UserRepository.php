<?php namespace App\Repositories;

use App\Entities\User;
use ExtendedSlim\Exceptions\RecordNotFoundException;
use PDO;

class UserRepository extends AbstractRepository
{
    /**
     * @param User $user
     */
    public function create(User $user)
    {
        $this->getConnection()->insert(UserTable::TABLE_NAME, [UserTable::FIELD_USER_NAME => $user->getUserName()]);
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
            ->select(UserTable::ENTITY_FIELDS)
            ->from(UserTable::TABLE_NAME)
            ->where(UserTable::FIELD_USER_NAME . ' = ' . $qB->createNamedParameter($name))
            ->setMaxResults(1)
            ->execute()
            ->fetch(PDO::FETCH_ASSOC);

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
