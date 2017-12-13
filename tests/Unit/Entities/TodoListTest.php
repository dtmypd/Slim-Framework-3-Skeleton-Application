<?php namespace App\Entities;

use Tests\AbstractTest;

class TodoListTest extends AbstractTest
{
    /**
     * @test
     */
    public function entityTest_Perfect_Perfect()
    {
        // Arrange
        $id             = 1;
        $expectedId     = 1;
        $name           = 'test name 1';
        $expectedName   = 'test name 1';
        $userId         = 11;
        $expectedUserId = 11;

        // Act
        $todoList = new TodoList($id, $name, $userId);

        // Assert
        $this->assertEquals($expectedId, $todoList->getId(), 'Entity id mismatch.');
        $this->assertEquals($expectedName, $todoList->getName(), 'Entity name mismatch.');
        $this->assertEquals($expectedUserId, $todoList->getUserId(), 'Entity user id mismatch.');
    }

    /**
     * @test
     *
     * @param int|null $id
     * @param int|null $expectedId
     * @param string   $name
     * @param string   $expectedName
     * @param int      $userId
     * @param int      $expectedUserId
     *
     * @dataProvider \Unit\Entities\TodoListTestProvider::provideEntityTestValues()
     */
    public function entityTestWithProvider_Perfect_Perfect(
        ?int $id,
        ?int $expectedId,
        string $name,
        string $expectedName,
        int $userId,
        int $expectedUserId
    ) {
        // Arrange - provided
        // Act
        $todoList = new TodoList($id, $name, $userId);

        // Assert
        $this->assertEquals($expectedId, $todoList->getId(), 'Entity id mismatch.');
        $this->assertEquals($expectedName, $todoList->getName(), 'Entity name mismatch.');
        $this->assertEquals($expectedUserId, $todoList->getUserId(), 'Entity use id mismatch.');
    }
}
