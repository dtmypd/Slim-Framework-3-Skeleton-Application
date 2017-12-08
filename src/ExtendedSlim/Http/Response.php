<?php namespace ExtendedSlim\Http;

use Exception;
use Slim\Http\Response as SlimHttpResponse;

class Response extends SlimHttpResponse
{
    /**
     * @param mixed  $data
     * @param int    $replyCode
     * @param string $replyMessage
     * @param int    $statusCode
     *
     * @return static
     * @throws Exception
     */
    public function createRestApiResponse(
        $data = true,
        int $replyCode = 0,
        string $replyMessage = 'OK',
        int $statusCode = 200
    ): Response {
        if ($replyCode > 0 && $statusCode == 200)
        {
            throw new Exception("Status code setup is needed for error response");
        }

        return $this->withJson(new ResponseEntity($data, $replyCode, $replyMessage), $statusCode);
    }
}
