<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css" />
    <script type="text/javascript" src="js/random.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <meta charset="utf-8" />
    <meta name="description" content="Opis strony" />
    <meta name="keywords" content="Wyrazy kluczowe" />
</head>

<body>
    <section>
        <div>
            <?php
            if (isset($Error))
                echo $Error;
            ?>
        </div>
        <?php if (isset($_GET['id'])) : ?>
            <?php if ($post = $stmt->fetch()) : ?>
                <h1 class="title"><?php echo $post['title'] ?></h1>
                <div class="list">
                    <?php
                    do {
                    ?>
                        <div class='element'>
                            <img class='img' src="<?php echo PostURL($post); ?>" alt="<?php echo $post['IDpost'] ?>" />
                            <figcaption class='figpost'><?php echo $post['description'] ?></figcaption>
                        </div>
                    <?php
                    } while ($post = $stmt->fetch());
                    ?>
                <?php else : ?>
                    <?php redirect('home'); ?>
                <?php endif; ?>
            <?php else : ?>
                <?php redirect('pageNotFound'); ?>
            <?php endif; ?>
                </div>

                <div class="control">
                    <form style="display:none" method="post" id="hiddenactionform" name="form">
                        <input type="text" name="type" id="hiddenaction" value="" disabled=true>
                    </form>

                    <?php if (isset($vote)) : ?>
                        <?php if ($vote) : ?>
                            <?php if ($vote['vote']) : ?>
                                <img width="30" height="30" class="icons" onclick="onClick(event)" id="upvote.OFF" src="<?php echo IconsURL('UpVoteON') ?>" />
                                <div class="points"><?php echo $points['0']; ?></div>
                                <img width="30" height="30" class="icons" id="downvote.ON" src="<?php echo IconsURL('DownVoteOFF') ?>" />
                            <?php else : ?>
                                <img width="30" height="30" class="icons" id="upvote.ON" src="<?php echo IconsURL('UpVoteOFF') ?>" />
                                <div class="points"><?php echo $points['0']; ?></div>
                                <img width="30" height="30" class="icons" onclick="onClick(event)" id="downvote.OFF" src="<?php echo IconsURL('DownVoteON') ?>" />
                            <?php endif; ?>
                        <?php else : ?>
                            <img width="30" height="30" class="icons" onclick="onClick(event)" id="upvote.ON" src="<?php echo IconsURL('UpVoteOFF') ?>" />
                            <div class="points"><?php echo $points['0']; ?></div>
                            <img width="30" height="30" class="icons" onclick="onClick(event)" id="downvote.ON" src="<?php echo IconsURL('DownVoteOFF') ?>" />
                        <?php endif; ?>
                    <?php else : ?>
                        <img width="30" height="30" class="icons" id="upvote.ON" src="<?php echo IconsURL('UpVoteOFF') ?>" />
                        <div class="points"><?php echo $points['0']; ?></div>
                        <img width="30" height="30" class="icons" id="downvote.ON" src="<?php echo IconsURL('DownVoteOFF') ?>" />
                    <?php endif; ?>

                    <?php if (isset($favorite)) : ?>
                        <?php if ($favorite) : ?>
                            <img width="30" height="30" class="icons" onclick="onClick(event)" id="favorite.OFF" src="<?php echo IconsURL('FavoriteON') ?>" />
                        <?php else : ?>
                            <img width="30" height="30" class="icons" onclick="onClick(event)" id="favorite.ON" src="<?php echo IconsURL('FavoriteOFF') ?>" />
                        <?php endif ?>
                    <?php else : ?>
                        <img width="30" height="30" class="icons" id="favorite.ON" src="<?php echo IconsURL('FavoriteOFF') ?>" />
                    <?php endif; ?>

                    <?php if (array_key_exists('permission', $_SESSION) && ($_SESSION['permission'] == 'admin' || $_SESSION['permission'] == 'moderator')) : ?>
                        <?php if ($valid) : ?>
                            <img width="30" height="30" class="icons" onclick="onClickModal(event)" id="validate" src="<?php echo IconsURL('Valid') ?>" />
                        <?php endif ?>
                        <img width="30" height="30" class="icons" onclick="onClickModal(event)" id="delete" src="<?php echo IconsURL('Delete') ?>" />
                        <div id="actionModal" class="modal">
                            <div id="actionModalContent" class="modal-content">
                                <span onclick="onClickX(event)" class="close">&times;</span>
                                <button onclick="onClick(event)" id="Yes">Yes</button>
                                <button onclick="onClickX(event)" id="No">No</button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="comments">
                    <div class="addcomment">
                        <p style="font-size:40px;">Komentarze</p>
                        <form onsubmit="onAddComment(event)" id="FormComment" name="form">
                            <input type="text" name="comment" value="">
                            <input type=submit class="addcomment" value="Dodaj Komentarz" name="comment" id="Comment">
                        </form>
                    </div>
                    <?php if (count($sortedComments) != 0) : ?>
                        <?php foreach ($sortedComments as $key => $value) : ?>
                            <?php if ($sortedComments[$key]['IDparent'] != 0) : ?>
                                <div class="comment-answer">
                                    <p>
                                        Odpowiada na: <?php echo GetParentCommentText($sortedComments, $key) ?><br>
                                    <?php else : ?>
                                    <div class="comment">
                                        <p>
                                        <?php endif; ?>
                                        User: <?php echo $sortedComments[$key]['login'] ?><br>
                                        <?php echo $sortedComments[$key]['text'] ?><br>
                                        <form onsubmit="onVoteComment(event)" id="FormComment.<?php echo $sortedComments[$key]['IDcomment'] ?>" name="VoteComment">
                                            <?php if (isset($voteComments)) : ?>
                                            <input onclick="onClickCommentVote(event)" type=image class="icons" value="UpVote" name="CommentUpVote" id="CommentUpVote.<?php $sortedComments[$key]['IDcomment'] ?>" src="<?php echo IconsURL(GetCommentIconUpVote($voteComments, $sortedComments[$key]['IDcomment'])) ?>">
                                            <?php else : ?>
                                            <input type=image class="icons" value="UpVote" name="CommentUpVote" id="CommentUpVote.<?php $sortedComments[$key]['IDcomment'] ?>" src="<?php echo _ICON_PATH.DIRECTORY_SEPARATOR.'UpVoteOFF.png';  ?>">
                                            <?php endif; ?>
                                            <input style="display:none" type="text" name="ID" value="" disabled=true>
                                            <?php echo $sortedComments[$key]['points'] ?>
                                            <?php if (isset($voteComments)) : ?>
                                            <input onclick="onClickCommentVote(event)" type=image class="icons" value="DownVote" name="CommentDownVote" id="CommentDownVote.<?php $sortedComments[$key]['IDcomment'] ?>" src="<?php echo IconsURL(GetCommentIconDownVote($voteComments, $sortedComments[$key]['IDcomment'])) ?>"><br>
                                            <?php else : ?>
                                            <input type=image class="icons" value="UpVote" name="CommentUpVote" id="CommentUpVote.<?php $sortedComments[$key]['IDcomment'] ?>" src="<?php echo _ICON_PATH.DIRECTORY_SEPARATOR.'DownVoteOFF.png';  ?>">    
                                            <?php endif; ?>    
                                        </form>
                                        <label id="<?php echo $sortedComments[$key]['IDcomment'] ?>" onclick="onClickAnswerComment(event)">Odpowiedz</label>
                                        <form style="display:none" onsubmit="onAnswer(event)" id="AnswerComment.<?php echo $sortedComments[$key]['IDcomment'] ?>" name="AnswerComment">
                                            <input style="display:none" type="text" name="ID" value="" disabled=true>
                                            <input type="text" name="text" value="" disabled=true>
                                            <input type=submit value="Odpowiedz" name="answer" id="CommentAnswer" disabled=true>
                                        </form>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                                </div>
    </section>
</body>

</html>