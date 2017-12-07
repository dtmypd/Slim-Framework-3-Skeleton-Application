<?php namespace App\Entities;

use PHPUnit\Framework\TestCase;

class TodoListTest extends TestCase
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
        new TodoList($id, $name);

        // Assert
        $this->assertEquals($id, $expectedId, 'Entity id mismatch.');
        $this->assertEquals($name, $expectedName, 'Entity name mismatch.');
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
        new TodoList($id, $name);

        // Assert
        $this->assertEquals($id, $expectedId, 'Entity id mismatch.');
        $this->assertEquals($name, $expectedName, 'Entity name mismatch.');
    }
}