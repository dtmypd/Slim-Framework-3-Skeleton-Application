<?php namespace App\Controllers\Api\v1\TodoController;

use App\Controllers\AbstractAction;
use App\Requests\TodoRequests\ListRequest;
use App\Services\TodoService;
use Exception;
use ExtendedSlim\Factories\ValidatorFactory;
use ExtendedSlim\Http\HttpCodeConstants;
use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\RestApiResponse;

class ListAction extends AbstractAction
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
        $listRequest = new ListRequest($request->getParam('page', 0));
        $violations  = $validatorFactory->create()->validate($listRequest);

        if ($violations->count() > 0)
        {
            return $response->createRestApiResponse(
                new RestApiResponse(
                    $this->createErrorResponse($violations),
                    ResponseMessageConstants::VALIDATION_ERROR_ID, //@todo: create related
                    ResponseMessageConstants::VALIDATION_ERROR_MESSAGE, //@todo: create related
                    HttpCodeConstants::BAD_REQUEST
                )
            );
        }

        return $response->createRestApiResponse($todoService->search($listRequest->getPage()));
    }
}
