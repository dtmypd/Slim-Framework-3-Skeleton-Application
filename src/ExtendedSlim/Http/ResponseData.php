<?php namespace ExtendedSlim\Http;

use JsonSerializable;

class ResponseData implements JsonSerializable
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
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'data'         => $this->data,
            'replyCode'    => $this->replyCode,
            'replyMessage' => $this->replyMessage,
        ];
    }
}
