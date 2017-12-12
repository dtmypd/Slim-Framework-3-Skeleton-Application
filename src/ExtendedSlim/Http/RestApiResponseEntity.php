<?php namespace ExtendedSlim\Http;

use JsonSerializable;

class RestApiResponseEntity implements JsonSerializable
{
    /** @var mixed */
    private $data;

    /** @var integer */
    private $replyCode;

    /** @var string */
    private $replyMessage;

    /**
     * @param mixed  $data
     * @param int    $replyCode
     * @param string $replyMessage
     */
    public function __construct($data, int $replyCode, string $replyMessage)
    {
        $this->data         = $data;
        $this->replyCode    = $replyCode;
        $this->replyMessage = $replyMessage;
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
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'data'         => $this->data,
            'replyCode'    => $this->replyCode,
            'replyMessage' => $this->replyMessage,
        ];
    }
}
