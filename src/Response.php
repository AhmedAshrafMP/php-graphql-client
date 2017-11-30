<?php

declare(strict_types=1);

namespace Camuthig\Graphql\Client;

class Response
{
    /**
     * @var array|null
     */
    private $data;

    /**
     * @var array|null
     */
    private $errors;

    public function __construct(array $response)
    {
        $this->data = $response['data'] ?? null;
        $this->errors = $response['errors'] ?? null;

        if (!is_array($this->data) && !is_null($this->data)) {
            throw new Exception('Data was present but neither null nor an object/array');
        }

        if (!is_array($this->errors) && !is_null($this->errors)) {
            throw new Exception('Errors was present but neither null nor an object/array');
        }
    }

    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @return array|null
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }
}
