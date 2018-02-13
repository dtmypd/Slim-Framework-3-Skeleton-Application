<?php namespace EndToEnd;

use EndToEnd\Api\v1\Todo\ShowActionTestData;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

class ShowActionTest extends EndToEndTestBase
{
    /**
     * @test
     *
     * @runInSeparateProcess
     *
     * @throws Exception
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getInsertedRecord_perfect_perfect()
    {
        // Arrange
        (new ShowActionTestData($this->getConnection()))->getInsertedRecord_perfect();
        $getUri           = '/v1/todo/123';
        $expectedHttpCode = 200;
        $expectedTodoId   = 123;
        $expectedTodoName = 'todo 123';

        // Act
        $response       = $this->createGetRequest($getUri);
        $responseEntity = $this->createResponseEntityFromResponse($response);

//        // Assert
        $this->assertEquals($expectedHttpCode, $response->getStatusCode(), 'Status code mismatch.');
        $this->assertEquals($expectedTodoId, $responseEntity->getData()->id, 'Id mismatch.');
        $this->assertEquals($expectedTodoName, $responseEntity->getData()->name, 'Name mismatch.');
    }
}
