<?php
if(isset($_SESSION))
{
session_destroy();
redirect('home');
}
?>