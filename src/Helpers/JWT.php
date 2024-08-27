<?php

namespace App\Helpers;

use Firebase\JWT\JWT as JsonWebToken;
use Firebase\JWT\Key;

class JWT
{
    private const KEY = "tbk5eocBUJ5i3R_FrJygf3lQwPvkz1kNlw5EX9jfhFQ=";

    public static function generate($payload)
    {
        $data = [
            'data' => $payload,
            'exp' => time() + 86400, // Token expires in 24 hours
        ];

        return JsonWebToken::encode($data, self::KEY, 'HS256');
    }

    public static function decode($token)
    {
        try {
            $payload = JsonWebToken::decode($token, new Key(self::KEY, 'HS256'));

            // Check if the token is expired
            if ($payload->exp < time()) {
                return false;
            }

            return $payload->data;
        } catch (\Exception $e) {
            return false;
        }
    }
}
