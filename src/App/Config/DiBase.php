<?php
/**
 * Created by PhpStorm.
 * User: gabor.budai
 * Date: 2018.02.18.
 * Time: 23:20
 */

use DI\Bridge\Slim\CallableResolver;
use DI\Bridge\Slim\ControllerInvoker;
use DI\Container;
use ExtendedSlim\Database\Connection;
use ExtendedSlim\Factories\ConnectionFactory;
use ExtendedSlim\Factories\MemcachedFactory;
use ExtendedSlim\Factories\TranslatorFactory;
use ExtendedSlim\Factories\LoggerFactory;
use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\Response;
use Interop\Container\ContainerInterface;
use Invoker\Invoker;
use Invoker\ParameterResolver\AssociativeArrayResolver;
use Invoker\ParameterResolver\Container\TypeHintContainerResolver;
use Invoker\ParameterResolver\DefaultValueResolver;
use Invoker\ParameterResolver\ResolverChain;
use Slim\Http\Environment;
use Slim\Http\Headers;
use ExtendedSlim\Router;
use Symfony\Component\Translation\Translator;
use Monolog\Logger;

$baseConfig = [
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
