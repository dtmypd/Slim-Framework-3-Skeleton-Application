<?php namespace App\Controllers\Api\v1\UserController;

use App\Controllers\AbstractAction;
use App\Requests\UserRequests\CreateRequest;
use App\Services\UserService;
use Doctrine\DBAL\ConnectionException;
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
     * @param UserService      $userService
     * @param ValidatorFactory $validatorFactory
     *
     * @return Response
     * @throws Exception
     * @throws ConnectionException
     */
    public function __invoke(
        Request $request,
        Response $response,
        UserService $userService,
        ValidatorFactory $validatorFactory
    ): Response {
        $createRequest = new CreateRequest($request->getParam('name'));
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

        $restApiResponse = $userService->create($createRequest->getName());

        return $response->createRestApiResponse($restApiResponse);
    }
}
