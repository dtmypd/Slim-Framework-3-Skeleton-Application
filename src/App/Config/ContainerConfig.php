<?php namespace App\Config;

use App\Repositories\TodoRepository;
use App\Services\TodoService;
use DI;
use DI\Bridge\Slim\CallableResolver;
use DI\Bridge\Slim\ControllerInvoker;
use DI\Container;
use ExtendedSlim\App\PhpDIEntity;
use ExtendedSlim\App\PhpDIEntityContainer;
use ExtendedSlim\Database\Connection;
use ExtendedSlim\Factories\ConnectionFactory;
use ExtendedSlim\Factories\MemcachedFactory;
use ExtendedSlim\Factories\TranslatorFactory;
use ExtendedSlim\Factories\LoggerFactory;
use ExtendedSlim\Handlers\Error;
use ExtendedSlim\Handlers\NotAllowed;
use ExtendedSlim\Handlers\NotFound;
use ExtendedSlim\Handlers\PhpError;
use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\Response;
use Interop\Container\ContainerInterface;
use Invoker\Invoker;
use Invoker\ParameterResolver\AssociativeArrayResolver;
use Invoker\ParameterResolver\Container\TypeHintContainerResolver;
use Invoker\ParameterResolver\DefaultValueResolver;
use Invoker\ParameterResolver\ResolverChain;
use Memcached;
use Slim\Http\Environment;
use Slim\Http\Headers;
use ExtendedSlim\Router;
use Symfony\Component\Translation\Translator;
use Monolog\Logger;

class ContainerConfig
{
    /** @var array  */
    var $customConfigs;

    public function __construct($customConfigs = [])
    {
        $this->customConfigs = $customConfigs;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return array_merge($this->getBaseConfig(),
            $this->getAppDIConfig(),
            $this->getDotEnvDependentConfig(),
            $this->customConfigs
        );
    }

    /**
     * @return array
     */
    private function getAppDIConfig(): array
    {
        //@todo: move array to the /config/di_class_predefine.php
        $config = [
            (new PhpDIEntity(TodoService::class))
                ->setConstructorParameter('todoRepository', TodoRepository::class)
                ->setConstructorParameter('connection', Connection::class)
                ->setConstructorParameter('logger', Logger::class),
        ];

        $appDi = new PhpDIEntityContainer();

        foreach ($config as $item)
        {
            $appDi->pushClass($item);
        }

        return $appDi->getContainer();
    }

    /**
     * @return array
     */
    private function getBaseConfig(): array
    {
        //@todo: move array to the /config/di_base.php
        return [
            'settings.httpVersion'                       => '1.1',
            'settings.responseChunkSize'                 => 4096,
            'settings.outputBuffering'                   => 'append',
            'settings.determineRouteBeforeAppMiddleware' => false,
            'settings.displayErrorDetails'               => env('SLIM_DISPLAY_ERROR_DETAILS', false),
            'settings.addContentLengthHeader'            => true,
            'settings.routerCacheFile'                   => false,
            'settings'                                   => [
                'httpVersion'                       => DI\get('settings.httpVersion'),
                'responseChunkSize'                 => DI\get('settings.responseChunkSize'),
                'outputBuffering'                   => DI\get('settings.outputBuffering'),
                'determineRouteBeforeAppMiddleware' => DI\get('settings.determineRouteBeforeAppMiddleware'),
                'displayErrorDetails'               => DI\get('settings.displayErrorDetails'),
                'addContentLengthHeader'            => DI\get('settings.addContentLengthHeader'),
                'routerCacheFile'                   => DI\get('settings.routerCacheFile'),
            ],
            // Default Slim services
            'router'                                     => DI\object(Router::class)
                ->method('setCacheFile', \DI\get('settings.routerCacheFile')),
            Router::class                                => DI\get('router'),
            'environment'                                => function ()
            {
                return new Environment($_SERVER);
            },
            'request'                                    => function (ContainerInterface $c)
            {
                return Request::createFromEnvironment($c->get('environment'));
            },
            'response'                                   => function (ContainerInterface $c)
            {
                $headers  = new Headers(['Content-Type' => 'text/html; charset=UTF-8']);
                $response = new Response(200, $headers);

                return $response->withProtocolVersion($c->get('settings')['httpVersion']);
            },
            'foundHandler'                               => DI\object(ControllerInvoker::class)
                ->constructor(DI\get('foundHandler.invoker')),
            'foundHandler.invoker'                       => function (ContainerInterface $c)
            {
                $resolvers = [
                    new AssociativeArrayResolver(),
                    new TypeHintContainerResolver($c),
                    new DefaultValueResolver(),
                ];

                return new Invoker(new ResolverChain($resolvers), $c);
            },
            'callableResolver'                           => DI\object(CallableResolver::class),
            ContainerInterface::class                    => DI\get(Container::class),
            Connection::class                            => DI\factory([ConnectionFactory::class, 'create']),
            Translator::class                            => DI\factory([TranslatorFactory::class, 'create'])
                ->parameter('translationResourcePath', realpath(__DIR__ . '/../resources/translations')),
            Memcached::class                             => DI\factory([MemcachedFactory::class, 'create']),
            Logger::class                                => DI\factory([LoggerFactory::class, 'create']),
        ];
    }

    /**
     * @return array
     */
    private function getDotEnvDependentConfig(): array
    {
        if (in_array(getenv('APP_ENV'), ['DEV', 'TEST']))
        {
            //@todo: move array to the /config/di_dev.php
            return [
                'errorHandler'      => DI\object(Error::class)
                    ->constructor(
                        DI\get('settings.displayErrorDetails'),
                        DI\get('settings.outputBuffering')
                    ),
                'phpErrorHandler'   => DI\object(PhpError::class)
                    ->constructor(
                        DI\get('settings.displayErrorDetails'),
                        DI\get('settings.outputBuffering')
                    ),
                'notFoundHandler'   => DI\object(NotFound::class),
                'notAllowedHandler' => DI\object(NotAllowed::class),
            ];
        }

        return [];
    }
}
