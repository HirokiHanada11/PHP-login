<?php

/**
 * XSS prevention, escape  handling
 * @param string $str 
 * @return string  
 */
function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * CSRF prevention
 * @param void
 * @return string $csrf_token
 */
function setToken() {
    //geenrate token
    //send token from form
    //verify token at sent
    //delete token
    $csrf_token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrf_token;

    return $csrf_token;
}

?>