<?php
session_start();
function redirect($url)
{
    header("Location: index.php?action=$url",TRUE,301);
}
function testInput($data) 
{ 
    $data = trim($data);
    $data = htmlspecialchars($data);   
    return $data;
}
define('_ROOT_PATH', dirname(__FILE__));  
$actions = array('home', 'register', 'login', 'lobby','post','settings','postval','users'); 
$action = 'home'; 

try { 
    $db = new PDO('mysql:host=localhost;dbname=siproject;port=3306', 'root','', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    
    }  
    catch (PDOException $e) { 
    echo 'Błąd: '.$e->getMessage(); 
    }


if (array_key_exists('action', $_GET)) 
{ 
    if (in_array($_GET['action'] , $actions))
    { 
        $action = $_GET['action']; 
    } 
    else
    { 
        $action = 'pageNotFound'; 
    } 
} 
if(file_exists(_ROOT_PATH.DIRECTORY_SEPARATOR.'actions'.DIRECTORY_SEPARATOR.$action.'.php'))
    include(_ROOT_PATH.DIRECTORY_SEPARATOR.'actions'.DIRECTORY_SEPARATOR.$action.'.php'); 
if(file_exists(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.$action.'.php'))
    include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.$action.'.php');
?>