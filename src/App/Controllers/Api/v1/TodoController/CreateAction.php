<?php namespace App\Controllers\Api\v1\TodoController;

use App\Controllers\AbstractAction;
use App\Requests\TodoRequests\CreateRequest;
use App\Services\TodoService;
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
     * @param TodoService      $todoService
     * @param ValidatorFactory $validatorFactory
     *
     * @return Response
     * @throws Exception
     */
    public function __invoke(
        Request $request,
        Response $response,
        TodoService $todoService,
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

        $restApiResponse = $todoService->create($createRequest->getName(), $createRequest->getUserId());

        return $response->createRestApiResponse($restApiResponse);
    }
}
