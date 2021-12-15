<?php
if (array_key_exists('user', $_SESSION)) 
{ 
    redirect('home');
}
else if (isset($_POST['submit']))
{
    if (empty($_POST['login']))
    {
        $Error= 'Login or password field cannot be empty'; 
    }
    if (empty($_POST['password']))
    {
        $Error= 'Login or password field cannot be empty'; 
    }
    if(!isset($Error))
    {
        $stmt = $db->prepare('SELECT IDuser,login,password,birthday,permission FROM users WHERE login = :login');
        $stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user!=0 && password_verify($_POST['password'], $user['password']))
        {
            $_SESSION["id"]=$user['IDuser'];
            $_SESSION["login"]=$user['login'];
            $_SESSION["permission"]=$user['permission'];
            $_SESSION["birthday"]=$user['birthday'];
            redirect('home');
        } else {
            $Error= 'Login or password is incorrect'; 
        }
    }
}
?>