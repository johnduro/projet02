<?php

$baseUrl = "/sensurbain/";

/* echo $_SERVER['REDIRECT_URL']; */

/* echo "TESSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSTTTTTTTTTTTTTTTTTTTTTTT"; */
    /* echo "<pre>"; */
    /* var_dump($_SERVER); */
    /* echo "</pre>"; */

/* echo "ici"; */
$path = array();
$path["general_css"] = $baseUrl."sens_style.css";
$path['jquery'] = $baseUrl."js/jquery-1.11.1.min.js";
$path["home"] = $baseUrl;
$path["contact"] = $baseUrl."contact/";
$path["leCollectif"] = $baseUrl."le-collectif/";
$path['logo_fb'] = $baseUrl."images/FB-f-Logo__blue_50.png";
$path['logo_twit'] = $baseUrl."images/twitter-logo.png";
/* Bouger dans le controller de home à la fin ?
   Seulement les url qui sont sur cette page */
$path['projets']['index'] = $baseUrl."projets/";

if ($baseUrl === $_SERVER['REDIRECT_URL'])
{
    header("Status: 200 OK", false, 200);
    require 'index_home.php';
}
else if (preg_match("#le-collectif/$#isU", $_SERVER['REDIRECT_URL']))
{
    header("Status: 200 OK", false, 200);
    require 'le_collectif/index_collectif.php';
}
else if (preg_match("#contact/$#isU", $_SERVER['REDIRECT_URL']))
{
    header("Status: 200 OK", false, 200);
    require 'contact/index_contact.php';
}
else if (preg_match("#projets/#isU", $_SERVER['REDIRECT_URL']))
{
    require 'projetsLayer/projetsController.php';
}
else
{
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    require 'error404.php';
}
