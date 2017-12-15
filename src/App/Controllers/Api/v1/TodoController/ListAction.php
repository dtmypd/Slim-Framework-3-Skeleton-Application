<?php namespace App\Controllers\Api\v1\TodoController;

use App\Services\TodoService;
use Exception;
use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\RestApiResponse;

class ListAction
{
    /**
     * @param Request     $request
     * @param Response    $response
     * @param TodoService $todoService
     *
     * @return Response
     * @throws Exception
     */
    public function __invoke(Request $request, Response $response, TodoService $todoService): Response
    {
        return $response->createRestApiResponse(
            new RestApiResponse(
                [
                    'todoList' => $todoService->search()
                ]
            )
        );
    }
}
