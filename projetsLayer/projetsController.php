<?php

$isOk = FALSE;

if (preg_match("#projets/$#isU", $_SERVER['REDIRECT_URL']))
{
    header("Status: 200 OK", false, 200);
    $isOk = TRUE;
}
else
{
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    require 'error404.php';
}

if ($isOk)
{
    include_once('header.html');
    include_once('body_projets.html');
    include_once('footer.html');
}
