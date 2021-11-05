<?php

namespace App\Services\v1;

class ServiceResult
{
    protected $fields = [
        'data' => [],
        'code' => null
    ];

    public function __construct(array $fields = [])
    {
        return $this->fill($fields);
    }

    public function __get($name)
    {
        return $this->fields[$name];
    }

    public function __set($name, $value)
    {
        return $this->fields[$name] = $value;
    }

    public function fill($fields)
    {
        foreach ($fields as $key => $value) {
            $this->fields[$key] = $value;
        }
        return $this;
    }

    public function toArray()
    {
        return $this->fields;
    }

    public function isSuccess()
    {
        return $this->fields['code'] == 200;
    }
}