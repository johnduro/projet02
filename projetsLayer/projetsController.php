<?php

$isOk = FALSE;
/* $projet = "urba-1.html"; */

if (preg_match("#projets/$#isU", $_SERVER['REDIRECT_URL']) || preg_match("#projets/urbanisme/$#isU", $_SERVER['REDIRECT_URL']))
{
    header("Status: 200 OK", false, 200);
    $isOk = TRUE;
}
else if (preg_match("#projets/architecture/$#isU", $_SERVER['REDIRECT_URL']))
{
    /* $projet = "archi-1.html"; */
    $isOk = TRUE;
}
else if (preg_match("#projets/conception-urbaine/$#isU", $_SERVER['REDIRECT_URL']))
{
    /* $projet = "concept-1.html"; */
    $isOk = TRUE;
}
else
{
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    require 'error404.php';
}
/* echo "<pre>"; */
$data = simplexml_load_file("projetsLayer/resources/projet-urba-1.xml");
/* $data = yaml_parse_file("resources/projet-urba-1.yml"); */
/* var_dump($data); */
/* echo "</pre>"; */

if ($isOk)
{
    include_once('header.html');
    include_once('body_projets.html');
    include_once('projets.html');
    include_once('footer.html');
}
