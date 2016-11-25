<?php

class ParagonIE_Sodium_Crypto
{
    /**
     * @param string $message
     * @param string $key
     * @return string
     */
    public static function auth($message, $key)
    {

    }

    /**
     * @param string $mac
     * @param string $message
     * @param string $key
     * @return bool
     */
    public static function auth_verify($mac, $message, $key)
    {
        return hash_equals(
            $mac,
            self::auth($message, $key)
        );
    }

    /**
     * @param string $plaintext
     * @param string $nonce
     * @param string $pk
     * @param string $sk
     * @return string
     */
    public static function box($plaintext, $nonce, $pk, $sk)
    {
        $k = ParagonIE_Sodium_Core_X25519::scalarmult($pk, $sk);
        $c = self::secretbox($plaintext, $nonce, $k);
        ParagonIE_Sodium_Compat::memzero($k);
        return $c;
    }

    /**
     * @param string $ciphertext
     * @param string $nonce
     * @param string $pk
     * @param string $sk
     * @return string
     */
    public static function box_open($ciphertext, $nonce, $pk, $sk)
    {
        $k = ParagonIE_Sodium_Core_X25519::scalarmult($pk, $sk);
        $p = self::secretbox_open($ciphertext, $nonce, $k);
        ParagonIE_Sodium_Compat::memzero($k);
        return $p;
    }

    /**
     * @param string $plaintext
     * @param string $nonce
     * @param string $key
     * @return string
     */
    public static function secretbox($plaintext, $nonce, $key)
    {
        $subkey = ParagonIE_Sodium_Core_HSalsa20::hsalsa20($nonce, $key, null);
    }

    /**
     * @param string $ciphertext
     * @param string $nonce
     * @param string $key
     * @return string
     */
    public static function secretbox_open($ciphertext, $nonce, $key)
    {

    }

    /**
     * @param string $message
     * @param string $sk
     * @return string
     */
    public static function sign_detached($message, $sk)
    {
        return ParagonIE_Sodium_Core_Ed25519::sign_detached($message, $sk);
    }

    /**
     * @param string $message
     * @param string $sk
     * @return string
     */
    public static function sign($message, $sk)
    {
        return ParagonIE_Sodium_Core_Ed25519::sign($message, $sk);
    }

    /**
     * @param string $signedMessage
     * @param string $pk
     * @return string
     */
    public static function sign_open($signedMessage, $pk)
    {
        return ParagonIE_Sodium_Core_Ed25519::sign_open($signedMessage, $pk);
    }

    /**
     * @param string $signature
     * @param string $message
     * @param string $pk
     * @return bool
     */
    public static function sign_verify_detached($signature, $message, $pk)
    {
        return ParagonIE_Sodium_Core_Ed25519::verify_detached($signature, $message, $pk);
    }
}
