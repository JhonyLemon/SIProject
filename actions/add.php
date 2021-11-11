<?php
$errors=array();
if (isset($_POST['submit']))
{
    if (is_uploaded_file($_FILES['file']['tmp_name'])) 
    { 
        $max_size=1024*100;
      //  $temp = explode(".", $_FILES["file"]["name"]);
        $dest = './graphics/' . $_FILES['file']['name'];
        if ($_FILES['file']['size'] == 0) 
        {  
            $errors['file']='Plik jest pusty'; 
        } 
        else if ($_FILES['file']['size'] > $max_size) 
        { 
            $errors['file']= 'Plik jest za duży maksymalnie można wysłać '.$max_size; 
        } 
        else if (file_exists($dest)) 
        { 
            $errors['file']= 'Wczytywany plik już istnieje na serwerze.'; 
        } 
        else if(!isset($errors['file']))
        {
            if (!@move_uploaded_file($_FILES['file']['tmp_name'], $dest)) 
            $errors['file']= 'Błąd: Nie można zapisać pliku gdyż podana lokalizacja nie istnieje lub nie można w nim zapisywać';
        }
    }
    else if (empty($_POST['description']))
    {
        $errors['description']= 'Description cannot be empty';
    }
    if (empty($_POST['title']))
    {
        $errors['title']= 'Title cannot be empty';
    }
    if(count($errors)==0)
    {

    }
}
?>

