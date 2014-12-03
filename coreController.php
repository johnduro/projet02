<?php
$baseUrl = "/sensurbain/";

$path = array();

$path["css"][] = $baseUrl."resources/css/general.css";
$path['start-js'][] = $baseUrl."resources/js/jquery-1.11.1.min.js";
$path['end-js'][] = array();

$path["home"] = $baseUrl;
$path["contact"] = $baseUrl."contact/";
$path["leCollectif"] = $baseUrl."le-collectif/";

$path['logo_fb'] = $baseUrl."images/FB-f-Logo__blue_50.png";
$path['logo_twit'] = $baseUrl."images/twitter-logo.png";

$path['projets']['index'] = $baseUrl."projets/";
$path['projets']['urbanisme'] = $path['projets']['index']."urbanisme/";
$path['projets']['architecture'] = $path['projets']['index']."architecture/";
$path['projets']['conception-urbaine'] = $path['projets']['index']."conception-urbaine/";

$pageSelected = "";


if ($baseUrl === $_SERVER['REDIRECT_URL'])
{
    header("Status: 200 OK", false, 200);
    require 'homeLayer/homeController.php';
}
else if (preg_match("#le-collectif/$#isU", $_SERVER['REDIRECT_URL']))
{
    header("Status: 200 OK", false, 200);
    $pageSelected = "le-collectif";
    require 'le-collectifLayer/le-collectifController.php';
}
else if (preg_match("#contact/$#isU", $_SERVER['REDIRECT_URL']))
{
    header("Status: 200 OK", false, 200);
    $pageSelected = "contact";
    require 'contactLayer/contactController.php';
}
else if (preg_match("#projets/#isU", $_SERVER['REDIRECT_URL']))
{
    require 'projetsLayer/projetsController.php';
}
else
{
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    require 'mainViews/error404.php';
}
