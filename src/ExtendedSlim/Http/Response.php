<?php namespace ExtendedSlim\Http;

use Exception;
use Slim\Http\Response as SlimHttpResponse;

class Response extends SlimHttpResponse
{
    /**
     * @param RestApiResponse $restApiResponse
     *
     * @return static
     * @throws Exception
     */
    public function createRestApiResponse(RestApiResponse $restApiResponse): Response
    {
        if ($restApiResponse->getReplyCode() > 0 && $restApiResponse->getStatusCode() == 200)
        {
            throw new Exception("Status code setup is needed for error response");
        }

        return $this->withJson(
            new RestApiResponseEntity(
                $restApiResponse->getData(),
                $restApiResponse->getReplyCode(),
                $restApiResponse->getReplyMessage()
            ),
            $restApiResponse->getStatusCode()
        );
    }
}
