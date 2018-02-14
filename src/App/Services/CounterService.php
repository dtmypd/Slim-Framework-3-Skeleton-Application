<?php namespace App\Services;

use ExtendedSlim\Services\SessionService;

class CounterService
{
    /** @var SessionService */
    private $sessionService;

    /**
     * @param SessionService $sessionService
     */
    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    /**
     * @param int $number
     *
     * @return int
     */
    public function addAndGet(int $number): int
    {
        if (!$this->sessionService->exists('counter_add_value'))
        {
            $this->sessionService->set('counter_add_value', $number);

            return $this->sessionService->get('counter_add_value');
        }

        return $this->sessionService->increment('counter_add_value', $number)->get('counter_add_value');
    }
}
