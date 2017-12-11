<?php namespace App\Controllers\Api\v1\TodoListController;

use App\Services\TodoListService;
use Exception;
use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\RestApiResponse;

class ListAction
{
    /**
     * @param Request         $request
     * @param Response        $response
     * @param TodoListService $todoListService
     *
     * @return Response
     * @throws Exception
     */
    public function __invoke(Request $request, Response $response, TodoListService $todoListService): Response
    {
        return $response->createRestApiResponse(
            new RestApiResponse(
                [
                    'todoList' => $todoListService->search()
                ]
            )
        );
    }
}
