<?php namespace ExtendedSlim\Http;

use Exception;
use Slim\Http\Response as SlimHttpResponse;

class Response extends SlimHttpResponse
{
    /**
     * @param mixed   $data
     * @param integer $replyCode
     * @param string  $replyMessage
     * @param integer $statusCode
     *
     * @return static
     * @throws Exception
     */
    public function createRestApiResponse(
        $data = true,
        $replyCode = 0,
        $replyMessage = 'OK',
        $statusCode = 200
    ): Response {
        if ($replyCode > 0 && $statusCode == 200)
        {
            throw new Exception("Status code setup is needed for error response");
        }

        return $this->withJson(new ResponseData($data, $replyCode, $replyMessage), $statusCode);
    }
}
