<?php

function setEncrypt($string,$secret_key='74j5f3d'){
    $encrypt_method = "AES-256-CBC";
    $secret_key = $secret_key;
    $secret_iv = 'M0dulBu4t4n4sk4R4';
    // hash
    $key = hash('sha256', $secret_key);

    $iv = substr(hash('sha256', $secret_iv), 0, 2);

    $output = openssl_encrypt($string, $encrypt_method, $key, 0);
    $output = base64_encode($output);

    return $output;
}
function getDecrypt($string,$secret_key='74j5f3d'){
    $encrypt_method = "AES-256-CBC";
    $secret_key = $secret_key;
    $secret_iv = 'M0dulBu4t4n4sk4R4';
    // hash
    $key = hash('sha256', $secret_key);

    $iv = substr(hash('sha256', $secret_iv), 0, 2);
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0);

    return $output;
}

?>