<?php
// Requires: composer require zircote/swagger-php
/**
 * @OA\Get(
 *   path="/api/hello",
 *   @OA\Response(response=200, description="Say hello")
 * )
 */
function hello() { echo 'Hello, API!'; }
// To generate docs: ./vendor/bin/openapi --output swagger.json .
echo 'Swagger annotations added. Run openapi tool to generate docs.';
