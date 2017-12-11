<?php namespace App\Controllers\Api\v1\TodoListController;

use App\Controllers\AbstractAction;
use App\Requests\TodoListRequests\CreateRequest;
use App\Services\TodoListService;
use Exception;
use ExtendedSlim\Factories\ValidatorFactory;
use ExtendedSlim\Http\HttpCodeConstants;
use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\RestApiResponse;

class CreateAction extends AbstractAction
{
    /**
     * @param Request          $request
     * @param Response         $response
     * @param TodoListService  $todoListService
     * @param ValidatorFactory $validatorFactory
     *
     * @return Response
     * @throws Exception
     */
    public function __invoke(
        Request $request,
        Response $response,
        TodoListService $todoListService,
        ValidatorFactory $validatorFactory
    ): Response {
        $createRequest = new CreateRequest($request->getParam('name'), $request->getParam('user_id'));
        $violations    = $validatorFactory->create()->validate($createRequest);

        if ($violations->count() > 0)
        {
            return $response->createRestApiResponse(
                new RestApiResponse(
                    $this->createErrorResponse($violations),
                    ResponseMessageConstants::VALIDATION_ERROR_ID,
                    ResponseMessageConstants::VALIDATION_ERROR_MESSAGE,
                    HttpCodeConstants::BAD_REQUEST
                )
            );
        }

        $restApiResponse = $todoListService->create($request->getParam('name'), $request->getParam('user_id'));

        return $response->createRestApiResponse($restApiResponse);
    }
}
