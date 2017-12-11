<?php namespace App\Controllers\Api\v1\TodoListController;

use App\Services\TodoListService;
use Exception;
use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\RestApiResponse;

class ListAction
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
     *
     * @return Response
     * @throws Exception
     */
    public function __invoke(Request $request, Response $response)
    {
        return $response->createRestApiResponse(
            new RestApiResponse(
                [
                    'todoList' => $this->todoListService->search()
                ]
            )
        );
    }
}
