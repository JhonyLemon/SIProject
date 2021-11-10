<?php
if(isset($_SESSION['perm']) && $_SESSION['perm']=='admin')
{
    if (isset($_POST['submit']))
    {
        $Error='';
        if (empty($_POST['surname']))
        {
            $Error.= 'Nazwisko jest wymagane<br>';
        }
        if (empty($_POST['name']))
        {
            $Error.= 'Imie jest wymagane<br>';
        }
        if (empty($_POST['login']))
        {
            $Error.= 'Login jest wymagany<br>';
        }
        else
        {
            $stmt = $db->prepare("SELECT login FROM user WHERE login=:login");
            $stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR); 
            $stmt->execute();
            $login = $stmt->fetchAll();
            if(count($login)>0)
            $Error.= 'Podany login jest zajęty<br>';
        }
        if (empty($_POST['password']))
        {
            $Error.= 'Haslo jest wymagane<br>';
        }
        if (empty($_POST['age']))
        { 
            $Error.= 'Wiek jest wymagany<br>'; 
        }
        if (empty($_POST['permission']))
        { 
            $Error.= 'Uprawnienia są wymagane<br>'; 
        }
        if($Error=='')
        {
            try { 
                $db->beginTransaction();
                $add = $db->prepare('INSERT IGNORE INTO user (id,name,surname,login,password,age,permission) VALUES(NULL, :name, :surname,:login,:password,:age,:permission)');
                $add->bindValue(':name', $_POST['name'], PDO::PARAM_STR); 
                $add->bindValue(':surname', $_POST['surname'], PDO::PARAM_STR); 
                $add->bindValue(':login', $_POST['login'], PDO::PARAM_STR); 
                $add->bindValue(':password', sha1($_POST['password']), PDO::PARAM_STR); 
                $add->bindValue(':age', $_POST['age'], PDO::PARAM_INT); 
                $add->bindValue(':permission', $_POST['permission'], PDO::PARAM_STR); 
                $add->execute();
                $add->closeCursor();
                $add = null;
                $db->commit();
                $ok='Dodano użytkownika';
            }
            catch(PDOException $e)
            {
                $db->rollBack();
                $Alert='Operacja nie powiodła się';
            }
        }
    }
}
else
{
    redirect('form');
}

?>