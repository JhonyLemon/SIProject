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
                            $row=PostURL($post);
                            // var_dump(_PHOTO_PATH.DIRECTORY_SEPARATOR.$posts['IDphoto'].'.'.$posts['ext']);
                            echo "
                            <div class='element'>
                            <img class='img' src=\"{$row['url']}\" alt=\"{$row['alt']}\"/>
                             <figcaption class='figpost'>{$row['description']}</figcaption>
                             </div>";
                        }while($post=$stmt->fetch());

                    }
                    else
                    {
                        redirect('home');
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

            <?php if (isset($vote)): ?>
                <?php if ($vote): ?>
                    <?php if ($vote['vote']): ?>
                        <img width="30" height="30" class="icons" onclick="onClick(event)" id="upvote.OFF" src="<?php echo IconsURL('UpVoteON') ?>"/>
                        <?php echo $points['0']; ?>
                        <img width="30" height="30" class="icons" id="downvote.ON" src="<?php echo IconsURL('DownVoteOFF') ?>"/>
                    <?php else: ?>
                        <img width="30" height="30" class="icons" id="upvote.ON" src="<?php echo IconsURL('UpVoteOFF') ?>"/>
                        <?php echo $points['0']; ?>
                        <img width="30" height="30" class="icons" onclick="onClick(event)" id="downvote.OFF" src="<?php echo IconsURL('DownVoteON') ?>"/>
                    <?php endif ?>
                <?php else: ?>
                    <img width="30" height="30" class="icons" onclick="onClick(event)" id="upvote.ON" src="<?php echo IconsURL('UpVoteOFF') ?>"/>
                    <?php echo $points['0']; ?>
                    <img width="30" height="30" class="icons" onclick="onClick(event)" id="downvote.ON" src="<?php echo IconsURL('DownVoteOFF') ?>"/>
                <?php endif ?>
            <?php else: ?>
                <img width="30" height="30" class="icons" id="upvote.ON" src="<?php echo IconsURL('UpVoteOFF') ?>"/>
                <?php echo $points['0']; ?>
                <img width="30" height="30" class="icons" id="downvote.ON" src="<?php echo IconsURL('DownVoteOFF') ?>"/>
            <?php endif ?>

            <?php if (isset($favorite)): ?>
                <?php if ($favorite): ?>
                    <img width="30" height="30" class="icons" onclick="onClick(event)" id="favorite.OFF" src="<?php echo IconsURL('FavoriteON') ?>"/>
                <?php else: ?>
                    <img width="30" height="30" class="icons" onclick="onClick(event)" id="favorite.ON" src="<?php echo IconsURL('FavoriteOFF') ?>"/>
                <?php endif ?>
            <?php else: ?>
                <img width="30" height="30" class="icons" id="favorite.ON" src="<?php echo IconsURL('FavoriteOFF') ?>"/>
            <?php endif ?>

            <?php if (array_key_exists('permission',$_SESSION) && ($_SESSION['permission']=='admin' || $_SESSION['permission']=='moderator')): ?>
                <?php if ($valid): ?>
                    <img width="30" height="30" class="icons" onclick="onClickModal(event)" id="validate" src="<?php echo IconsURL('Valid') ?>"/>
                <?php endif ?>
                <img width="30" height="30" class="icons" onclick="onClickModal(event)" id="delete" src="<?php echo IconsURL('Delete') ?>"/>
                <div id="actionModal" class="modal">
                    <div id="actionModalContent" class="modal-content">
                        <span onclick="onClickX(event)" class="close">&times;</span>
                        <button onclick="onClick(event)" id="Yes">Yes</button>
                        <button onclick="onClickX(event)" id="No">No</button>
                    </div>
                </div>
            <?php endif ?>


                <?php
                /*
                if(isset($vote))
                {
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
                }
                else
                {
                    echo "<input type='image' width='30' height='30' class='icons' id='upvote.ON' src=\"".'icons'.DIRECTORY_SEPARATOR.'UpVoteOFF.png'."\"/>";
                    echo $points['0'];
                    echo "<input type='image' width='30' height='30' class='icons' id='downvote.ON' src=\"".'icons'.DIRECTORY_SEPARATOR.'DownVoteOFF.png'."\"/>";
                
                }
                
                if(isset($favorite))
                {
                    if($favorite)
                    {
                        echo "<input type='image' width='30' height='30' class='icons' onclick='onClick(event)' id='favorite.OFF' src=\"".'icons'.DIRECTORY_SEPARATOR.'FavoriteON.png'."\"/>";
                    }
                    else
                    {
                        echo "<input type='image' width='30' height='30' class='icons' onclick='onClick(event)' id='favorite.ON' src=\"".'icons'.DIRECTORY_SEPARATOR.'FavoriteOFF.png'."\"/>";
                    }
                } 
                else
                {
                    echo "<input type='image' width='30' height='30' class='icons' id='favorite.ON' src=\"".'icons'.DIRECTORY_SEPARATOR.'FavoriteOFF.png'."\"/>";
                }
                if(array_key_exists('permission',$_SESSION) && ($_SESSION['permission']=='admin' || $_SESSION['permission']=='moderator'))
                {
                    if($valid)
                    echo "<input type='image' width='30' height='30' class='icons' onclick='onClickModal(event)' id='validate' src=\"".'icons'.DIRECTORY_SEPARATOR.'Valid.png'."\"/>";
                    echo "<input type='image' width='30' height='30' class='icons' onclick='onClickModal(event)' id='delete' src=\"".'icons'.DIRECTORY_SEPARATOR.'Delete.png'."\"/>";
                    echo "<div id='actionModal' class='modal'>
                            <div id='actionModalContent' class='modal-content'>
                                <span onclick='onClickX(event)' class='close'>&times;</span>
                                <button onclick='onClick(event)' id='Yes'>Yes</button>
                                <button onclick='onClickX(event)' id='No'>No</button>
                            </div>
                          </div>";
                }
                */
?>
                
            </div>
        </section>
</body> 
</html>