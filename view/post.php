<!DOCTYPE html> 
<html> 
<head> 
<link rel="stylesheet" href="style.css" />
<meta charset="utf-8" /> 
<meta name="description" content="Opis strony" /> 
<meta name="keywords" content="Wyrazy kluczowe" /> 
<title>Tytuł strony</title> 
</head> 
<body> 
        <header>
            <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'header.php'); ?>      
        </header>
        <section>
        <div class="list">
                <?php
                if(isset($_GET['id']))
                {
                    
                    if($post=$stmt->fetch())
                    {
                        echo '<h1>'.$post['title'].'</h1>';
                        do
                        {
                            // var_dump(_PHOTO_PATH.DIRECTORY_SEPARATOR.$posts['IDphoto'].'.'.$posts['ext']);
                            echo "
                            <div class='element'>
                            <img class='img' src=\""._PHOTO_PATH.DIRECTORY_SEPARATOR.$post['IDphoto'].'.'.$post['ext']."\" alt=\"".$post['IDpost']."\"/>
                             <figcaption class='figpost'>{$post['description']}</figcaption>
                             </div>";
                        }while($post=$stmt->fetch());
                    }
                }
                else
                {
                    redirect('pageNotFound');
                }
                ?>
            </div>
        </section>
        <footer>
            <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'footer.php'); ?>
        </footer>
</body> 
</html>