<?php
//plik z akcjami
//session_start();
if (!array_key_exists('user', $_SESSION)) 
{ 
    redirect('form');
}
?>