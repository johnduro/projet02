<?php

$isOk = FALSE;
$data = array();
if (preg_match("#projets\/$#isU", $_SERVER['REDIRECT_URL']) || preg_match("#projets\/urbanisme\/$#isU", $_SERVER['REDIRECT_URL']))
{
    $isOk = TRUE;
    $data["categorie"] = "urbanisme";
}
else if (preg_match("#projets/urbanisme/#isU", $_SERVER['REDIRECT_URL']))
{
    preg_match("#projets\/urbanisme\/([a-zA-Z0-9\-_]*)$#isU", $_SERVER['REDIRECT_URL'], $ret, PREG_OFFSET_CAPTURE);
    if (isset($ret[1][0]))
    {
        if (file_exists("projetsLayer/resources/urbanisme/".$ret[1][0]))
        {
            $data["categorie"] = "urbanisme";
            $data["projet"] = $ret[1][0];
            $isOk = TRUE;
        }
    }
}
else if (preg_match("#projets/architecture/#isU", $_SERVER['REDIRECT_URL']))
{
    if (preg_match("#projets/architecture/$#isU", $_SERVER['REDIRECT_URL']))
    {
        $isOk = TRUE;
        $data["categorie"] = "architecture";
    }
    else
    {
        preg_match("#projets\/architecture\/([a-zA-Z0-9\-_]*)$#isU", $_SERVER['REDIRECT_URL'], $ret, PREG_OFFSET_CAPTURE);
        if (isset($ret[1][0]))
        {
            if (file_exists("projetsLayer/resources/architecture/".$ret[1][0]))
            {
                $data["categorie"] = "architecture";
                $data["projet"] = $ret[1][0];
                $isOk = TRUE;
            }
        }
    }
}
else if (preg_match("#projets/conception-urbaine/#isU", $_SERVER['REDIRECT_URL']))
{
    if (preg_match("#projets/conception-urbaine/$#isU", $_SERVER['REDIRECT_URL']))
    {
        $isOk = TRUE;
        $data["categorie"] = "conception-urbaine";
    }
    else
    {
        preg_match("#projets\/conception-urbaine\/([a-zA-Z0-9\-_]*)$#isU", $_SERVER['REDIRECT_URL'], $ret, PREG_OFFSET_CAPTURE);
        if (isset($ret[1][0]))
        {
            if (file_exists("projetsLayer/resources/conception-urbaine/".$ret[1][0]))
            {
                $data["categorie"] = "conception-urbaine";
                $data["projet"] = $ret[1][0];
                $isOk = TRUE;
            }
        }
    }
}
else
{
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    require 'mainViews/error404.php';
}

if ($isOk)
{
    $projectDirs["urbanisme"] = scandir("projetsLayer/resources/urbanisme");
    $projectDirs["architecture"] = scandir("projetsLayer/resources/architecture");
    $projectDirs["conception-urbaine"] = scandir("projetsLayer/resources/conception-urbaine");
    $projectLinks = array();
    $toReplace = array("-", "_");
    $replaceWith = array(" ", "'");
    foreach ($projectDirs as $type => $dirs)
    {
        foreach ($dirs as $dirname)
        {
            if ($dirname[0] != ".")
            {
                $projectLinks[$type][] = array("name" => str_replace($toReplace, $replaceWith, $dirname), "link" => $dirname);
                if (!isset($projectLinks["defaultProject"][$type]))
                {
                    $projectLinks["defaultProject"][$type] = $dirname;
                }
            }
        }
    }
    if (!isset($data["projet"]))
    {
        if (isset($data["categorie"]))
        {
            if (isset($projectLinks["defaultProject"][$data["categorie"]]))
                $data["projet"] = $projectLinks["defaultProject"][$data["categorie"]];
            else
            {
                $isOk = FALSE;
            }
        }
        else
        {
            $data["projet"] = $projectLinks["defaultProject"]["urbanisme"];
            $data["categorie"] = "urbanisme";
        }
    }

    if ($isOk)
    {
        header("Status: 200 OK", false, 200);
        $projectSelectedPath = $baseUrl."projetsLayer/resources/".$data["categorie"]."/".$data["projet"]."/";
        $data["xml"] = simplexml_load_file("projetsLayer/resources/".$data["categorie"]."/".$data["projet"]."/infos.xml");
        $pageSelected = "projets";
        $path["css"][] = $baseUrl."resources/css/projets.css";
        $path['end-js'][] = $baseUrl."resources/js/jquery.ui.effect.min.js";
        $path['end-js'][] = $baseUrl."resources/js/diaporama.js";
        include_once('mainViews/header.html');
        include_once('projetsBody.html');
        include_once('projetsTemplate.html');
        include_once('mainViews/footer.html');
    }
    else
    {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
        require 'mainViews/error404.php';
    }
}
else
{
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    require 'mainViews/error404.php';
}

function printSidebarProjectsLinks($projectLinks, $categorie, $path, $projet)
{
    if (isset($projectLinks[$categorie]))
    {
        foreach ($projectLinks[$categorie] as $link)
        {
            if ($link["link"] === $projet)
                echo "<b>";
            echo "<a href=".$path["projets"][$categorie]['index'].$link["link"].">- ".$link["name"]."</a><br/>";
            if ($link["link"] === $projet)
                echo "</b>";
        }
    }
}

function boxSelected($data, $box, $color)
{
    if ($box === $data["categorie"])
    {
        echo "current selected-box-".$color;
    }
}
