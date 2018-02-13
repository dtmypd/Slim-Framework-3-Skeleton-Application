<?php namespace EndToEnd;

use Exception;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

class IndexActionTest extends EndToEndTestBase
{
    /**
     * @test
     *
     * @runInSeparateProcess
     *
     * @throws Exception
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     */
    public function staticWebResponse_perfect()
    {
        // Arrange
        $expectedResponseBody = 'HTML part can go later with Twig!';
        $getUri               = '/';
        $expectedStatusCode   = 200;

        // Act
        $response = $this->createGetRequest($getUri);

        // Assert
        $this->assertEquals($expectedStatusCode, $response->getStatusCode(), 'Status code mismatch.');
        $this->assertEquals($expectedResponseBody, (string)$response->getBody(), 'Response body mismatch.');
    }
}
