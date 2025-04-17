<?php
// Requires: composer require webonyx/graphql-php
require 'vendor/autoload.php';
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
$type = new ObjectType([
    'name'=>'Query',
    'fields'=>[
        'hello'=>[ 'type'=>Type::string(), 'resolve'=>fn()=>"Hello, GraphQL!" ]
    ]
]);
$schema = new Schema(['query'=>$type]);
$raw = json_decode(file_get_contents('php://input'),true);
$result = GraphQL::executeQuery($schema, $raw['query'] ?? '{hello}');
header('Content-Type: application/json');
echo json_encode($result->toArray());
