<?php namespace ExtendedSlim\Services;

/**
 * @url https://github.com/bryanjhv/slim-session
 */
class SessionService
{
    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->exists($key) ? $_SESSION[$key] : $default;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @param int    $value
     *
     * @return $this
     */
    public function increment($key, int $value)
    {
        $_SESSION[$key] += $value;

        return $this;
    }

    /**
     * @param string $key
     * @param int    $value
     *
     * @return $this
     */
    public function decrement($key, int $value)
    {
        $_SESSION[$key] -= $value;

        return $this;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function merge($key, $value)
    {
        if (is_array($value) && is_array($old = $this->get($key)))
        {
            $value = array_merge_recursive($old, $value);
        }

        return $this->set($key, $value);
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function delete($key)
    {
        if ($this->exists($key))
        {
            unset($_SESSION[$key]);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $_SESSION = [];

        return $this;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function exists($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    /**
     * @param bool $new
     *
     * @return string
     */
    public static function id($new = false)
    {
        if ($new && session_id())
        {
            session_regenerate_id(true);
        }

        return session_id() ?: '';
    }

    public static function sessionStart()
    {
        session_start();
    }

    public static function destroy()
    {
        if (self::id())
        {
            session_unset();
            session_destroy();
            session_write_close();

            if (ini_get('session.use_cookies'))
            {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 4200,
                    $params['path'],
                    $params['domain'],
                    $params['secure'],
                    $params['httponly']
                );
            }
        }
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($_SESSION);
    }
}
