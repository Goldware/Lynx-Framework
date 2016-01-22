<?php 

/* 
Lynx Framework - Goldware 2016
init.php
Author : Sacha Wendling
Date : 08/01/2016
License : GNU GPL v3
*/

// start session
session_start();

// init data framework array 
$data = array();

// configuration of framework
include('config.php');

// lynx modules
include('core/modules.php');

// load models
include('core/model/get.php');
include('core/model/set.php');

// compilation scss to css
if($useSass && $useOwnCss)
{
    $PhpSass = new PhpSass;
    $PhpSass->compileToCss('core/sass/' . $ownSassDir, 'core/css/' . $ownCssDir);
}

// archiving ip
if($archiveRequest)
{
    $today = date('Ymd');
    $archive_today = fopen('archive/' . $today . '.log', 'a+');
    $line = '[' . date("Y-m-d H:i:s") . '] - ' . $_SERVER['REMOTE_ADDR'] . "\n";
    fputs($archive_today, $line);
    fclose($archive_today); 
}

?>