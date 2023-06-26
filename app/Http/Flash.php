<?php


namespace App\Http;


class Flash
{
    public function create($message, $level)
    {
        return session()->flash($level, $message);
    }

    public function info($message)
    {
        $this->create($message, 'info');
    }

    public function success($message)
    {
        $this->create($message, 'success');
    }

    public function warning($message)
    {
        $this->create($message, 'warning');
    }

    public function error($message)
    {
        $this->create($message, 'error');
    }

}
