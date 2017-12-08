<?php namespace App\Controllers\Api\v1\TodoListController;

use App\Services\TodoListService;
use Exception;
use ExtendedSlim\Exceptions\RecordNotFoundException;
use ExtendedSlim\Http\HttpCodeConstants;
use ExtendedSlim\Http\Response;
use Slim\Http\Request;
use Slim\Route;

class ShowAction
{
    /** @var TodoListService */
    private $todoListService;

    /**
     * @param TodoListService $todoListService
     */
    public function __construct(TodoListService $todoListService)
    {
        $this->todoListService = $todoListService;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param Route    $route
     *
     * @return Response
     * @throws Exception
     */
    public function __invoke(Request $request, Response $response, Route $route): Response
    {
        try
        {
            return $response->createRestApiResponse(
                [
                    'todoList' => $this->todoListService->getById((int)$route->getArgument('id'))
                ]
            );
        }
        catch (RecordNotFoundException $e)
        {
            return $response->createRestApiResponse(
                $request->getAttributes(),
                ResponseMessageConstants::TODO_ITEM_ERROR_ID,
                ResponseMessageConstants::TODO_ITEM_ERROR_MESSAGE,
                HttpCodeConstants::BAD_REQUEST
            );
        }
    }
}
