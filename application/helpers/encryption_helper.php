<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function encrypt_password($password) {
    $secret_key = 'my_secret_key_123'; 
    $cipher = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = random_bytes($iv_length);

    $encrypted_password = openssl_encrypt($password, $cipher, $secret_key, 0, $iv);
    return base64_encode($iv . $encrypted_password); 
}

function decrypt_password($encrypted_password) {
    $secret_key = 'my_secret_key_123';
    $cipher = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($cipher);

    $decoded = base64_decode($encrypted_password);
    $iv = substr($decoded, 0, $iv_length);
    $ciphertext = substr($decoded, $iv_length);

    return openssl_decrypt($ciphertext, $cipher, $secret_key, 0, $iv);
}
?>
