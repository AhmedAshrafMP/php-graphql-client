# PHP GraphQL Client

A simple GraphQL client for PHP 7.1+

## Install

```bash
composer require camuthig/graphql-client
```

## Usage

```php
<?php

use Camuthig\GraphqlClient\Client;

$client = new Client('https://9jv9z4w3kr.lp.gql.zone/graphql');

$graphql = <<<'GRAPHQL'
query($input: String) {
  hello(input: $input)
}
GRAPHQL;

$result = $client->execute($graphql, ['input' => 'everyone']);

var_dump($result);
/*
array(2) {
 ["data"]=>
 array(1) {
   ["hello"]=>
   string(15) "Hello everyone!"
 }
 ["extensions"]=>
 array(0) {
 }
}
 */

```