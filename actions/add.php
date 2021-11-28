<?php
if(array_key_exists('title',$_POST))
{ 
            try 
            { 
                $db->beginTransaction();

                    $stmt = $db->prepare('INSERT INTO posts (title) VALUES (:title)');
                    $stmt->bindValue(':title', $_POST['title']);
                    $stmt->execute();
                    $stmt->closeCursor();
                    $id=$db->lastInsertId();
                    for($i=0; $i<count($_FILES['files']['name']); $i++)
                    {
                        $temp = explode(".", $_FILES["files"]["name"][$i]);
                        $stmt = $db->prepare('INSERT INTO photos (IDpost,description,ext) VALUES (:id,:description,:ext)');
                        $stmt->bindValue(':id', $id);
                        $stmt->bindValue(':description', $_POST['descriptions'][$i]);
                        $stmt->bindValue(':ext', end($temp));
                        $stmt->execute();
                        $stmt->closeCursor();
                        $id_photo=$db->lastInsertId();
                        
                        $dest = _PHOTO_PATH.DIRECTORY_SEPARATOR . $id_photo .'.'. end($temp);
                        if (!@move_uploaded_file($_FILES['files']['tmp_name'][$i], $dest)) 
                        {
                            throw new Exception;
                        }
                    }
                    $stmt = $db->prepare('INSERT INTO userposts (IDuser,IDpost) VALUES (:IDuser,:IDpost)');
                    $stmt->bindValue(':IDuser', $_SESSION["id"]);
                    $stmt->bindValue(':IDpost', $id);
                    $stmt->execute();
                    $stmt->closeCursor();
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

