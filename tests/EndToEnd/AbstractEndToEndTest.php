<?php namespace EndToEnd;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ConnectionException;
use Exception;
use ExtendedSlim\App;
use ExtendedSlim\App\Config;
use ExtendedSlim\Http\RestApiResponseEntity;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;
use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\Request;
use Slim\Http\Environment;
use ExtendedSlim\Tests\AbstractTest;

abstract class AbstractEndToEndTest extends AbstractTest
{
    /** @var bool */
    protected $withMiddleware = true;

    /** @var App */
    private $app;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function setUp()
    {
        parent::setUp();

        require_once __DIR__ . '/../../vendor/autoload.php';
        (new Config(realpath(__DIR__ . "/../../")))->envSetup();
        $app = new App();

        require __DIR__ . '/../../routes/api.php';
        require __DIR__ . '/../../routes/web.php';

        $this->app = $app;

        $this->getConnection()->beginTransaction();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ConnectionException
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->getConnection()->rollBack();
    }

    /**
     * @param string     $requestMethod
     * @param string     $requestUri
     * @param array|null $requestData
     *
     * @return ResponseInterface|Response
     * @throws Exception
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     */
    private function runApp(string $requestMethod, string $requestUri, array $requestData = null)
    {
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI'    => $requestUri
            ]
        );

        $request = Request::createFromEnvironment($environment);

        if (null !== $requestData)
        {
            $request = $request->withParsedBody($requestData);
        }

        $response = new Response();

        return $this->app->process($request, $response);
    }

    /**
     * @param string $requestUri
     *
     * @return Response|ResponseInterface
     * @throws Exception
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     */
    protected function createGetRequest(string $requestUri)
    {
        return $this->runApp('GET', $requestUri);
    }

    /**
     * @param string $requestUri
     * @param array  $postData
     *
     * @return Response|ResponseInterface
     * @throws Exception
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     */
    protected function createPostRequest(string $requestUri, array $postData)
    {
        return $this->runApp('POST', $requestUri, $postData);
    }

    /**
     * @return Connection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function getConnection(): Connection
    {
        return $this->app->getContainer()->get(Connection::class);
    }

    /**
     * @param Response $response
     *
     * @return RestApiResponseEntity
     * @throws Exception
     */
    protected function createResponseEntityFromResponse(Response $response)
    {
        $body = json_decode((string)$response->getBody());
        if (json_last_error() !== JSON_ERROR_NONE)
        {
            var_dump((string)$response->getBody()); //@todo: find a better way to display body
            throw new Exception('Invalid JSON returned.');
        }

        return new RestApiResponseEntity($body->data, $body->replyCode, $body->replyMessage);
    }
}
