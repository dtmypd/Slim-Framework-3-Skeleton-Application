<?php namespace App\Controllers\Api\v1\TodoController;

use App\Services\TodoService;
use Exception;
use ExtendedSlim\Exceptions\RecordNotFoundException;
use ExtendedSlim\Http\HttpCodeConstants;
use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\RestApiResponse;
use Slim\Route;

class ShowAction
{
    /**
     * @param Request     $request
     * @param Response    $response
     * @param Route       $route
     * @param TodoService $todoService
     *
     * @return Response
     * @throws Exception
     */
    public function __invoke(
        Request $request,
        Response $response,
        Route $route,
        TodoService $todoService
    ): Response {
        try
        {
            return $response->createRestApiResponse(
                new RestApiResponse(
                    [
                        'todoList' => $todoService->getById((int)$route->getArgument('id'))
                    ]
                )
            );
        }
        catch (RecordNotFoundException $e)
        {
            return $response->createRestApiResponse(
                new RestApiResponse(
                    $request->getAttributes(),
                    ResponseMessageConstants::TODO_ITEM_ERROR_ID,
                    ResponseMessageConstants::TODO_ITEM_ERROR_MESSAGE,
                    HttpCodeConstants::BAD_REQUEST
                )
            );
        }
    }
}
