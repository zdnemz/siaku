<?php

namespace App\Helpers;

use Firebase\JWT\JWT as JsonWebToken;
use Firebase\JWT\Key;

class JWT
{
    private static string $key;

    public static function init(): void
    {
        self::$key = getenv('JWT_TOKEN') ?: 'fallback-secret-key';
    }

    public static function generate($payload)
    {
        $data = [
            'data' => $payload,
            'exp' => time() + 86400,
        ];

        return JsonWebToken::encode($data, self::$key, 'HS256');
    }

    public static function decode($token)
    {
        try {
            $payload = JsonWebToken::decode($token, new Key(self::$key, 'HS256'));

            if ($payload->exp < time()) {
                return false;
            }

            return $payload->data;
        } catch (\Exception $e) {
            return false;
        }
    }
}
