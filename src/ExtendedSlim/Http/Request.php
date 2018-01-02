<?php namespace ExtendedSlim\Http;

class Request extends \Slim\Http\Request
{
    /**
     * Fetch request parameter value from body or query string (in that order) and cast it to string.
     *
     * Note: This is an extended method of the slim Request::getParam method.
     *
     * @param string $key     The parameter key.
     * @param string $default The default value.
     *
     * @return mixed The parameter value as a string.
     */
    public function getParam($key, $default = null)
    {
        return (string)parent::getParam($key, $default);
    }
}
