<?php

session_start();

$captcha = random_int(10000, 99999);
$_SESSION['$captcha'] = $captcha;

var_dump($captcha);

?>
