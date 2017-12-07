<?php namespace App\Repositories;

use DI\DependencyException;
use DI\NotFoundException;
use ExtendedSlim\App;
use Integration\AbstractIntegrationTest;
use Integration\Repositories\TodoListRepositoryTestData;
use InvalidArgumentException;
use PDO;

class TodoListRepositoryTest extends AbstractIntegrationTest
{
    /** @var $todoListRepository TodoListRepository */
    private $todoListRepository;

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function setUp()
    {
        parent::setUp();

        $this->todoListRepository = $this->getFromContainer(TodoListRepository::class);
    }

    /**
     * @test
     *
     * @throws InvalidArgumentException
     */
    public function create_insertNewTodo_Perfect()
    {
        // Arrange
        (new TodoListRepositoryTestData($this->getConnection()))->create_insertNewTodo_Perfect();
        $createName   = 'name test';
        $createUserId = 1;
        $expectedName = 'name test';

        // Act
        $this->todoListRepository->create($createName, $createUserId);

        // Assert
        $qB   = $this->createQueryBuilder();
        $rows = $qB
            ->select(1)
            ->from(TodoListTable::TABLE_NAME)
            ->where(TodoListTable::FIELD_NAME . ' = ' . $qB->createNamedParameter($expectedName))
            ->execute()
            ->fetchAll(PDO::FETCH_ASSOC);

        $this->assertCount(1, $rows, 'Wrong number of returned records.');
    }
}
