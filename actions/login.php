<?php
if (array_key_exists('user', $_SESSION)) 
{ 
    redirect('home');
}
else if (isset($_POST['submit']))
{
    $Error= array();
    if (empty($_POST['login']))
    {
        $Error['login']= 'Login field cannot be empty'; 
    }
    if (empty($_POST['password']))
    {
        $Error['password']= 'Login field cannot be empty'; 
    }
    if(count($Error)==0)
    {
        $stmt = $db->prepare('SELECT IDuser,login,password,birthday,permission FROM users WHERE login = :login');
        $stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch();
        //password_verify($password, $hashed_password)
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