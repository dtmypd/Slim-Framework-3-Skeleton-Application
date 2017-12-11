<?php namespace ExtendedSlim\Http;

use JsonSerializable;

class RestApiResponse implements JsonSerializable
{
    /** @var mixed */
    private $data;

    /** @var int */
    private $replyCode;

    /** @var string */
    private $replyMessage;

    /** @var int */
    private $statusCode;

    /**
     * @param mixed  $data
     * @param int    $replyCode
     * @param string $replyMessage
     * @param int    $statusCode
     */
    public function __construct(
        $data = true,
        int $replyCode = 0,
        string $replyMessage = 'OK',
        int $statusCode = 200
    ) {
        $this->data         = $data;
        $this->replyCode    = $replyCode;
        $this->replyMessage = $replyMessage;
        $this->statusCode   = $statusCode;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getReplyCode(): int
    {
        return $this->replyCode;
    }

    /**
     * @return string
     */
    public function getReplyMessage(): string
    {
        return $this->replyMessage;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'data'         => $this->data,
            'replyCode'    => $this->replyCode,
            'replyMessage' => $this->replyMessage,
            'statusCode'   => $this->statusCode,
        ];
    }
}
