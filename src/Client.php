<?php

declare(strict_types=1);

namespace Camuthig\Graphql\Client;

class Client
{
    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var array
     */
    private $headers;

    public function __construct(string $endpoint, array $headers = [])
    {
        $this->endpoint = $endpoint;
        $this->headers = array_merge($headers, [
            'Content-Type: application/json',
            'Accept: application/json',
        ]);
    }

    public function execute(string $query, ?array $variables = []): array
    {
        $body = [
            'query' => $query,
            'variables' => $variables,
        ];

        $ch = curl_init($this->endpoint);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

        $result = curl_exec($ch);

        if ($result === false) {
            throw new Exception('Unknown failure executing request on GraphQL server');
        }

        return json_decode($result, true);
    }
}
