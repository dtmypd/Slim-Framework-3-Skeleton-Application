<?php namespace EndToEnd;

use Exception;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

class IndexActionTest extends AbstractEndToEndTest
{
    /**
     * @test
     *
     * @throws Exception
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     */
    public function staticWebResponse_perfect()
    {
        // Arrange
        $expectedResponseBody = 'HTML part can go later with Twig!';

        // Act
        $response = $this->createGetRequest('/');

        // Assert
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($expectedResponseBody, (string)$response->getBody(), 'Response body mismatch.');
    }
}
