<?php namespace ExtendedSlim\Http;

use Exception;

class Response extends \Slim\Http\Response
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
    public function createRestApiResponse($data = null, $replyCode = 0, $replyMessage = 'OK', $statusCode = 200)
    {
        if ($replyCode > 0 && $statusCode == 200)
        {
            throw new Exception("Status code setup is needed for error response");
        }

        return $this->withJson(new ResponseData($data, $replyCode, $replyMessage), $statusCode);
    }
}
