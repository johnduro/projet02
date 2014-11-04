<?php

$path = array();

/* $path["general_css"] = $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']."sens_style.css"; */
/* $path["general_css"] = "sens_style.css"; */
$path["general_css"] = "/sensurbain/sens_style.css";
/* $path["home"] = $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']."index.php"; */
/* $path["contact"] = $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']."contact/"; */
$path["home"] = "/sensurbain/";
$path["contact"] = "/sensurbain/contact/";
/* define('CSS_GEN', '/sens_style.css'); */
/* echo $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']; */

include_once('header.html');
include_once('body_index.html');
include_once('footer.html');