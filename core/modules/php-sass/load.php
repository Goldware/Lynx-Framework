<?php

/* 
Lynx Framework - Goldware 2016
load.php
Author : Sacha Wendling
Date : 09/01/2016
License : GNU GPL v3
*/

class PhpSass
{
    function compileToCss($input, $output)
    {
        require('scss.inc.php');
        $scss = new scssc();
        
        $scss_file = fopen($input, 'r');
        $css_file = fopen($output, 'w');
        
        $scss_code = '';
        while(!feof($scss_file))
        {
            $scss_code = $scss_code . fgets($scss_file);
        }
        
        fputs($css_file, '/* Compilated from SASS */');
        fputs($css_file, $scss->compile($scss_code));
        fclose($css_file);
    }   
}

?>