<!DOCTYPE html> 
<html> 
<head> 
<link rel="stylesheet" href="style.css" />
<meta charset="utf-8" /> 
<meta name="description" content="Opis strony" /> 
<meta name="keywords" content="Wyrazy kluczowe" /> 
<script type="text/javascript" src="js/lobby.js"></script>
<title>Tytuł strony</title> 
</head> 
<body> 
        <section>
            <div class="tiles">
                <?php
                    while($posts=$stmt->fetch())
                    {
                       // var_dump(_PHOTO_PATH.DIRECTORY_SEPARATOR.$posts['IDphoto'].'.'.$posts['ext']);
                        echo "
                        <div onclick='onClick(event)' class='tile'>
                        <img src=\""._PHOTO_PATH.DIRECTORY_SEPARATOR.$posts['IDphoto'].'.'.$posts['ext']."\" alt=\"".$posts['IDpost']."\"/>
                        <figcaption class='figlobby'>{$posts['title']}</figcaption>
                        </div>";
                    }
                ?>
            </div>
        </section>
</body> 
</html>