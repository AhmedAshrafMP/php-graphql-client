<?php

declare(strict_types=1);

namespace Camuthig\Graphql\Client\Test;

use Camuthig\Graphql\Client\Client;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Camuthig\GraphqlClient\Client
 */
class GraphqlClientTest extends TestCase
{
    /**
     * @testdox It should execute a GraphQL request against a remote server
     */
    public function executesRequest()
    {
        $client = new Client('https://9jv9z4w3kr.lp.gql.zone/graphql');

        $graphql = <<<'GRAPHQL'
query($input: String) {
  hello(input: $input)
}
GRAPHQL;

        $result = $client->execute($graphql, ['input' => 'everyone']);

        $expected = [
            'data' => [
                'hello' => 'Hello everyone!',
            ],
            'extensions' => [],
        ];

        self::assertEquals($expected, $result);
    }
}
