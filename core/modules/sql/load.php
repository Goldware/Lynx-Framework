<?php 

/* 
Lynx Framework - Goldware 2016
init.php
Author : Sacha Wendling
Date : 09/01/2016
License : GNU GPL v3
*/

class Sql 
{
    function createDbConnection($host, $db_name, $user, $password, $charset)
    {
        try
        {
            $db = new PDO('mysql:host=' . $host . ';dbname=' . $db_name . ';charset=' . $charset , $user, $password);
        }
        catch (Exception $e)
        {
            die('Lynx Framework - ERR001 : ' . $e->getMessage());
        }       
        return $db;
    }
    
    function requestSql($db, $request, $req_array = [])
    {
        $req = $db->prepare($request);
        if(empty($req_array))
        {
            $req->execute();
            $response = array();
            while($row = $req->fetch())
            {
                array_push($response, $row);
            }
            return $response;
        }
        else
        {
            $req->execute($req_array);
            $response = array();
            while($row = $req->fetch())
            {
                array_push($response, $row);
            }
            return $response;
        }
    }
}

?>