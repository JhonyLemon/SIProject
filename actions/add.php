<?php
$errors=array();

if(array_key_exists('title',$_POST))
{
    var_dump($_POST);
    echo "<br>";
    var_dump($_FILES);









    
}



if (isset($_POST['add']))
{
    if (is_uploaded_file($_FILES['file']['tmp_name'])) 
    { 
        $max_size=1024*100;
        
        
        if ($_FILES['file']['size'] == 0) 
        {  
            $errors['file']='Plik jest pusty'; 
        } 
        else if ($_FILES['file']['size'] > $max_size) 
        { 
            $errors['file']= 'Plik jest za duży maksymalnie można wysłać '.$max_size; 
        } 
        /*else if (file_exists($dest)) 
        { 
            $errors['file']= 'Wczytywany plik już istnieje na serwerze.'; 
        }*/
    }
    /*
    if (empty($_POST['description']))
    {
        $errors['description']= 'Description cannot be empty';
    }
    */
  /*  if (empty($_POST['title']))
    {
        $errors['title']= 'Title cannot be empty';
    }
    else
    {
        $added['title']=$_POST['title'];
    }*/

/*
    if(count($errors)==0)
    {
        $id=count($added);
        $added[$id]=array();
        $added[$id]['file']=$_FILES['file'];
        if(!empty($_POST['description']))
            $added[$id]['description']=$_POST['description'];


        //$temp = explode(".", $_FILES["file"]["name"]);
       // $dest = './graphics/' . $_FILES['file']['name'];
    }
    */
}
?>

