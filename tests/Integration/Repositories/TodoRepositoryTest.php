<?php namespace App\Repositories;

use App\Entities\Todo;
use DI\DependencyException;
use DI\NotFoundException;
use ExtendedSlim\App;
use Integration\Repositories\TodoRepositoryTestData;
use InvalidArgumentException;
use Integration\IntegrationTestBase;
use PDO;

class TodoRepositoryTest extends IntegrationTestBase
{
    /** @var $todoRepository TodoRepository */
    private $todoRepository;

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function setUp()
    {
        parent::setUp();

        $this->todoRepository = $this->getFromContainer(TodoRepository::class);
    }

    /**
     * @test
     *
     * @throws InvalidArgumentException
     */
    public function create_insertNewTodo_Perfect()
    {
        // Arrange
        (new TodoRepositoryTestData($this->getConnection()))->create_insertNewTodo_Perfect();
        $createName   = 'name test';
        $createUserId = 1;
        $expectedName = 'name test';

        // Act
        $this->todoRepository->create(new Todo(null, $createName, $createUserId));

        // Assert
        $qB   = $this->createQueryBuilder();
        $rows = $qB
            ->setQueryId(__METHOD__)
            ->select(1)
            ->from(TodoTable::TABLE_NAME)
            ->where(TodoTable::FIELD_NAME . ' = ' . $qB->createNamedParameter($expectedName))
            ->execute()
            ->fetchAll(PDO::FETCH_ASSOC);

        $this->assertCount(1, $rows, 'Wrong number of returned records.');
    }
}
