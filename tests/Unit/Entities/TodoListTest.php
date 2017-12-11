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
        $id           = 1;
        $expectedId   = 1;
        $name         = 'test name 1';
        $expectedName = 'test name 1';

        // Act
        $todoList = new TodoList($id, $name);

        // Assert
        $this->assertEquals($expectedId, $todoList->getId(), 'Entity id mismatch.');
        $this->assertEquals($expectedName, $todoList->getName(), 'Entity name mismatch.');
    }

    /**
     * @test
     *
     * @param integer $id
     * @param integer $expectedId
     * @param string  $name
     * @param string  $expectedName
     *
     * @dataProvider \Unit\Entities\TodoListTestProvider::provideEntityTestValues()
     */
    public function entityTestWithProvider_Perfect_Perfect($id, $expectedId, $name, $expectedName)
    {
        // Arrange - provided
        // Act
        $todoList = new TodoList($id, $name);

        // Assert
        $this->assertEquals($expectedId, $todoList->getId(), 'Entity id mismatch.');
        $this->assertEquals($expectedName, $todoList->getName(), 'Entity name mismatch.');
    }
}