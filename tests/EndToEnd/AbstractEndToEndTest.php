<?php namespace EndToEnd;

use Exception;
use ExtendedSlim\App;
use ExtendedSlim\App\Config;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;
use Slim\Http\Request;
use ExtendedSlim\Http\Response;
use Slim\Http\Environment;

class AbstractEndToEndTest extends TestCase
{
    /** @var bool */
    protected $withMiddleware = true;

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
        require_once __DIR__ . '/../../vendor/autoload.php';

        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI'    => $requestUri
            ]
        );

        $request = Request::createFromEnvironment($environment);

        if (isset($requestData))
        {
            $request = $request->withParsedBody($requestData);
        }

        $response = new Response();

        (new Config())->envSetup();
        $app = new App();

        require_once __DIR__ . '/../../routes/api.php';
        require_once __DIR__ . '/../../routes/web.php';

        return $app->process($request, $response);
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
}
