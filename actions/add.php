<?php

if(array_key_exists('title',$_POST))
{
  //  var_dump($_POST);
  //  echo "<br>";
  //  var_dump($_FILES);
  //  echo "<br>";  
            try 
            { 
                $db->beginTransaction();
                    $stmt = $db->prepare('INSERT INTO posts (title) VALUES (:title)');
                    $stmt->bindValue(':title', $_POST['title']);
                    $stmt->execute();
                    $stmt->closeCursor();
                    $id=$db->lastInsertId();
                   // var_dump($id);
                   // echo "<br>";
                   // var_dump(count($_FILES['files']['name']));
                   // echo "<br>";
                    for($i=0; $i<count($_FILES['files']['name']); $i++)
                    {
                        $temp = explode(".", $_FILES["files"]["name"][$i]);
                        $stmt = $db->prepare('INSERT INTO photos (IDpost,description,ext) VALUES (:id,:description,:ext)');
                        $stmt->bindValue(':id', $id);
                        $stmt->bindValue(':description', $_POST['descriptions'][$i]);
                        $stmt->bindValue(':ext', $temp['1']);
                        $stmt->execute();
                        $stmt->closeCursor();
                        $id_photo=$db->lastInsertId();
                       // var_dump($id_photo);
                        
                        $dest = _PHOTO_PATH.DIRECTORY_SEPARATOR . $id_photo .'.'. $temp['1'];
                        if (!@move_uploaded_file($_FILES['files']['tmp_name'][$i], $dest)) 
                        {
                            throw new Exception;
                        }
                    }
                $db->commit();
                unset($_POST);
                $ok='Everything is okay';
            }
            catch(Expection $e)
            {
                $db->rollBack();
                $Error='Unexpected error occured';
            }
}
?>

