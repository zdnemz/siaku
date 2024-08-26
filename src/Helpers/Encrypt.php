<?php

namespace App\Helpers;

class Encrypt
{
    private static string $cipher = 'AES-256-CBC';
    private static string $key = 'QnV1VVlRZ2d6eEtVQ2tycXdrTmZ2MzYrWnZLR0xzU1U=';
    private static string $iv;

    public static function encrypt(string $string): string
    {
        self::$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$cipher));
        $encrypted = openssl_encrypt($string, self::$cipher, self::$key, 0, self::$iv);
        return base64_encode(self::$iv . $encrypted);
    }

    public static function decrypt(string $string): string
    {
        $data = base64_decode($string);

        if ($data === false) {
            throw new \InvalidArgumentException("Base64 decoding failed.");
        }

        $ivLength = openssl_cipher_iv_length(self::$cipher);
        if (strlen($data) < $ivLength) {
            throw new \InvalidArgumentException("Data length is shorter than the IV length.");
        }

        self::$iv = substr($data, 0, $ivLength);
        $encrypted = substr($data, $ivLength);

        $decrypted = openssl_decrypt($encrypted, self::$cipher, self::$key, 0, self::$iv);

        if ($decrypted === false) {
            throw new \InvalidArgumentException("Decryption failed. Ensure the data and key are correct.");
        }

        return $decrypted;
    }
}
