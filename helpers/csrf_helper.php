<?php

function csrf_get_token($key){
    $csrf = new Symfony\Component\Security\Csrf\CsrfTokenManager();
    $token = $csrf->getToken($key)->getValue();
    return $token;
}

function csrf_validate_token($key,$token){
    $csrf = new Symfony\Component\Security\Csrf\CsrfTokenManager();
    if($csrf->isTokenValid(new Symfony\Component\Security\Csrf\CsrfToken($key, $token))){
        return true;
    }
    else{
        return false;
    }
}

function csrf_input($key,$name='_csrf_token'){
    $token = csrf_get_token($key);
    echo '<input type="hidden" name="'.$name.'" value="'.$token.'">';
}

function csrf_input_validate($key,$name='_csrf_token'){
    $token = $_REQUEST[$name];
    if(csrf_validate_token($key,$token)){
        return true;
    }
    else{
        return false;
    }
}

?>