<?php

function delete_user($id,$db)
{
    try { 
        $db->beginTransaction();
        $delete = $db->prepare("DELETE FROM user WHERE id=:id");
        $delete->bindValue(':id', $id, PDO::PARAM_INT);
        $delete->execute();
        $delete->closeCursor();
        $db->commit();
        return 0;
    }
    catch(PDOException $e)
    {
        $db->rollBack();
        return 1;
    }
}

if(isset($_SESSION['perm']) && $_SESSION['perm']=='admin')
{
if(array_key_exists('id',$_GET) && array_key_exists('do',$_GET))
{
    $id=$_GET['id'];
    if($_GET['do']=='edit')
    {
        $do='edit';
        if (isset($_POST['edit']))
        {
            $changed_values=array();
            $Error='';
            if (!empty($_POST['name']))
            {
                $changed_values['name']=$_POST['name'];
            }
                
            if (!empty($_POST['surname']))
            {
                $changed_values['surname']=$_POST['surname'];
            }
            if (!empty($_POST['login']))
            {
                $stmt = $db->prepare("SELECT login FROM user WHERE login=:login");
                $stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR); 
                $stmt->execute();
                $login = $stmt->fetchAll();
                if(count($login)>0)
                    $Error= 'Podany login jest zajęty';
                else
                    $changed_values['login']=$_POST['login'];
            }
            if (!empty($_POST['password']))
            {
                $changed_values['password']=sha1($_POST['password']);
            }
            if (!empty($_POST['age']))
            { 
                $changed_values['age']=$_POST['age'];
            }
            if (!empty($_POST['permission']))
            { 
                $changed_values['permission']=$_POST['permission'];
            }
            if($Error=='' && count($changed_values)>0)
            {
                $tochange='';
                foreach ($changed_values as $key => $value)
                {
                    if($key!='age')
                    $tochange.=$key.'='.'"'.$value.'"'.',';
                    else
                    $tochange.=$key.'='.$value.',';
                }
                $tochange=substr($tochange, 0, -1);
                try { 
                    $db->beginTransaction();
                    $edit = $db->prepare("UPDATE user SET $tochange WHERE id=:id");
                    $edit->bindValue(':id', $id, PDO::PARAM_INT);
                    $edit->execute();
                    $edit->closeCursor();
                    $edit = null;
                    $db->commit();
                    $ok='Zmieniono dane użytkownika';
                    redirect('users');
                }
                catch(PDOException $e)
                {
                    $db->rollBack();
                    $alert='Błąd podczas zmieniania danych';
                }
            }
        }
    }
    elseif($_GET['do']=='delete')
    {
        $do='delete';
        if (isset($_POST['delete']))
        {
            
            $stmt = $db->prepare('SELECT permission FROM user WHERE id=:id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $admin = $stmt->fetch();
            if($admin['permission']=='admin')
            {
                $stmt = $db->prepare('SELECT id FROM user WHERE permission=:perm');
                $stmt->bindValue(':perm', 'admin', PDO::PARAM_STR);
                $stmt->execute();
                $admins = $stmt->fetchAll();  
                if(count($admins)>1)
                {
                    if(delete_user($id,$db)==1)
                    {
                        $alert='Błąd przy usuwaniu użytkownika';
                    }
                    else
                    {
                        redirect('users');
                        $ok='Usunięto użytkownika';
                    }
                }
                else
                $alert='Nie mozna usunac jedynego administratora';
            }
            else
            {
                if(delete_user($id,$db)==1)
                {
                    $alert='Błąd przy usuwaniu użytkownika';
                }
                else
                {
                    redirect('users');
                    $ok='Usunięto użytkownika';
                }
            }
        }
    }
    elseif($_GET['do']=='view')
    {
        $do='view';
        $stmt = $db->prepare("SELECT id,title,authors FROM book WHERE id=(SELECT idbook FROM borrowedbooks WHERE iduser=:id)");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
else
{
$stmt = $db->prepare("SELECT id,name,surname,login,age,permission FROM user");
$stmt->execute();
}
}
else
{
    redirect('home');
}
?>
