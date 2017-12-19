<?php namespace App\Controllers\Api\v1\TodoController;

use App\Controllers\AbstractAction;
use App\Requests\TodoRequests\ShowRequest;
use App\Services\TodoService;
use Exception;
use ExtendedSlim\Factories\ValidatorFactory;
use ExtendedSlim\Http\HttpCodeConstants;
use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\RestApiResponse;
use Slim\Route;

class ShowAction extends AbstractAction
{
    /**
     * @param Request          $request
     * @param Response         $response
     * @param Route            $route
     * @param TodoService      $todoService
     *
     * @param ValidatorFactory $validatorFactory
     *
     * @return Response
     * @throws Exception
     */
    public function __invoke(
        Request $request,
        Response $response,
        Route $route,
        TodoService $todoService,
        ValidatorFactory $validatorFactory
    ): Response {
        $showRequest = new ShowRequest($route->getArgument('id'));
        $violations  = $validatorFactory->create()->validate($showRequest);

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

        return $response->createRestApiResponse($todoService->getById($showRequest->getId()));
    }
}
