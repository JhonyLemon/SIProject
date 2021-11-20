<!DOCTYPE html> 
<html> 
<head> 
<link rel="stylesheet" href="style.css" />
<script type="text/javascript" src="js/post.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
        <div>
            <?php
            if(isset($Error))
                echo $Error;
            ?>
        </div>
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
            <div>
            <form style="display:none" method="post" id="hiddenactionform" name="form">
                <input type="text" name="type" id="hiddenaction" value="" disabled=true>
            </form>
                <?php
                if($vote)
                {
                    if($vote['vote'])
                    {
                        echo "<input type='image' width='30' height='30' class='icons' onclick='onClick(event)' id='upvote.OFF' src=\"".'icons'.DIRECTORY_SEPARATOR.'UpVoteON.png'."\"/>";
                        echo $points['0'];
                        echo "<input type='image' width='30' height='30' class='icons' onclick='onClick(event)' id='downvote.ON' src=\"".'icons'.DIRECTORY_SEPARATOR.'DownVoteOFF.png'."\"/>";
                    }
                    else
                    {
                        echo "<input type='image' width='30' height='30' class='icons' onclick='onClick(event)' id='upvote.ON' src=\"".'icons'.DIRECTORY_SEPARATOR.'UpVoteOFF.png'."\"/>";
                        echo $points['0'];
                        echo "<input type='image' width='30' height='30' class='icons' onclick='onClick(event)' id='downvote.OFF' src=\"".'icons'.DIRECTORY_SEPARATOR.'DownVoteON.png'."\"/>";
                
                    }

                }
                else
                {
                    echo "<input type='image' width='30' height='30' class='icons' onclick='onClick(event)' id='upvote.ON' src=\"".'icons'.DIRECTORY_SEPARATOR.'UpVoteOFF.png'."\"/>";
                    echo $points['0'];
                    echo "<input type='image' width='30' height='30' class='icons' onclick='onClick(event)' id='downvote.ON' src=\"".'icons'.DIRECTORY_SEPARATOR.'DownVoteOFF.png'."\"/>";
                }
                if($favorite)
                {
                    echo "<input type='image' width='30' height='30' class='icons' onclick='onClick(event)' id='favorite.OFF' src=\"".'icons'.DIRECTORY_SEPARATOR.'FavoriteON.png'."\"/>";
                }
                else
                {
                    echo "<input type='image' width='30' height='30' class='icons' onclick='onClick(event)' id='favorite.ON' src=\"".'icons'.DIRECTORY_SEPARATOR.'FavoriteOFF.png'."\"/>";
                }
?>
                
            </div>
        </section>
        <footer>
            <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'footer.php'); ?>
        </footer>
</body> 
</html>