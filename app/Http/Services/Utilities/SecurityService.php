<?php

namespace App\Http\Services\Utilities;

class SecurityService
{
    public static function cryptData($plaintext, $secret_key): string
    {
        $key = openssl_digest($secret_key, 'SHA256', true);

        $ivlen = openssl_cipher_iv_length("AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, "AES-128-CBC", $key, OPENSSL_RAW_DATA, $iv);

        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
        return base64_encode($iv . $hmac . $ciphertext_raw);
    }


    public static function decryptData($ciphertext, $secret_key)
    {
        $c = base64_decode($ciphertext);

        $key = openssl_digest($secret_key, 'SHA256', true);

        $ivlen = openssl_cipher_iv_length("AES-128-CBC");

        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, "AES-128-CBC", $key, OPENSSL_RAW_DATA, $iv);

        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
        if (hash_equals($hmac, $calcmac))
            return $original_plaintext;

        return false;
    }
}
