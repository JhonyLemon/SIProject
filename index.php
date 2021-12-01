<?php
ob_start();
error_reporting(E_ALL); 
ini_set('display_errors', TRUE);
session_start();

define('_ROOT_PATH', dirname(__FILE__)); 
define('_PHOTO_PATH', 'posts'); 
define('_ICON_PATH', 'icons');

require_once(_ROOT_PATH.DIRECTORY_SEPARATOR.'functions'.DIRECTORY_SEPARATOR.'library.php');
 
$actions = array('home', 'register', 'login', 'lobby','post','profil','postval','users','random','logout','add','pageNotFound'); 
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
{
    include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'header.php');
    include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.$action.'.php');
    include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'footer.php');
}
?>