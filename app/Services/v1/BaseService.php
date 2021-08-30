<?php

namespace App\Services\v1;

abstract class BaseService
{
    protected function errNotFound(string $message)
    {
        return $this->error(404, $message);
    }

    protected function errAccessDenied($message)
    {
        return $this->error(401, $message);
    }

    protected function errService($message)
    {
        return $this->error(500, $message);
    }

    protected function errValidate($message)
    {
        return $this->error(422, $message);
    }

    protected function ok($message)
    {
        return $this->result([
            'message' => $message
        ]);
    }

    protected function error(int $code, string $message)
    {
        return new ServiceResult([
            'data' => ['message' => $message],
            'code' => $code
        ]);
    }

    protected function result($data)
    {
        return new ServiceResult([
            'data' => $data,
            'code' => 200
        ]);
    }
}
