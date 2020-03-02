<?php
/**
 * Created by PhpStorm.
 * User: andre.luis.a.costa
 * Date: 30/11/2016
 * Time: 19:41
 */
function redirect ($url, $permanent = false) {
    if (headers_sent() === false) {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }
    exit();
}