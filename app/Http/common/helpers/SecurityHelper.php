<?php

use ReallySimpleJWT\Decode;
use ReallySimpleJWT\Jwt;
use ReallySimpleJWT\Parse;

function getPayload($request)
{
    $token = $request->bearerToken();

    $jwt = new Jwt($token);
    $parse = new Parse($jwt, new Decode());
    $parsed = $parse->parse();
    $payload = $parsed->getPayload();

    return $payload;
}
