<?php 

/* 
Lynx Framework - Goldware 2016
load.php
Author : Sacha Wendling
Date : 10/01/2016
License : GNU GPL v3
*/

class formChecker
{
    function isValidForm($post_array, $fields, $fieldIdOptional = [])
    {
        $i = 0;
        while($i != sizeof($post_array))
        {
            if(empty($post_array[$fields[$i]]) && !in_array($i, $fieldIdOptional))
            {
                return false;
            }
            else
            {
                $i++;
            }
        }
        return true;
    }
}

?>