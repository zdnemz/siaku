<?php

namespace App\Middlewares;
use App\Helpers\JWT;

class AuthMiddleware
{
    public static function handle()
    {
        if (isset($_SESSION['jwt'])) {
            $payload = JWT::decode($_SESSION['jwt']);

            if ($payload) {
                return $payload;
            }

            unset($_SESSION['jwt']);
            return null;
        }

        return null;
    }
}