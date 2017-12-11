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
    /** @var TodoListService */
    private $todoListService;

    /** @var ValidatorFactory */
    private $validatorFactory;

    /**
     * @param TodoListService  $todoListService
     * @param ValidatorFactory $validatorFactory
     */
    public function __construct(TodoListService $todoListService, ValidatorFactory $validatorFactory) {
        $this->todoListService  = $todoListService;
        $this->validatorFactory = $validatorFactory;
    }

    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     * @throws Exception
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $createRequest = new CreateRequest($request->getParam('name'), $request->getParam('user_id'));
        $violations    = $this->validatorFactory->create()->validate($createRequest);

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

        $restApiResponse = $this->todoListService->create($request->getParam('name'), $request->getParam('user_id'));

        return $response->createRestApiResponse($restApiResponse);
    }
}
