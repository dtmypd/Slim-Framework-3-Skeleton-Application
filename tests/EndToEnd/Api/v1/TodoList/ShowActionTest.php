<?php namespace EndToEnd;

use EndToEnd\Api\v1\TodoList\ShowActionTestData;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

class ShowActionTest extends AbstractEndToEndTest
{
    /**
     * @test
     *
     * @throws Exception
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getInsertedRecord_perfect()
    {
        // Arrange
        (new ShowActionTestData($this->getConnection()))->getInsertedRecord_perfect();
        $getUri               = '/v1/todo-list/123';
        $expectedHttpCode     = 200;
        $expectedTodoListId   = 123;
        $expectedTodoListName = 'todo 123';

        // Act
        $response = $this->createGetRequest($getUri);
        $responseEntity = $this->createResponseEntityFromResponse($response);

        // Assert
        $this->assertEquals($expectedHttpCode, $response->getStatusCode(), 'Status code mismatch.');
        $this->assertEquals($expectedTodoListId, $responseEntity->getData()->todoList->id, 'Id mismatch.');
        $this->assertEquals($expectedTodoListName, $responseEntity->getData()->todoList->name, 'Name mismatch.');
    }
}
