<!DOCTYPE html> 
<html> 
<head> 
<link rel="stylesheet" href="style.css" />
<meta charset="utf-8" /> 
<meta name="description" content="Opis strony" /> 
<meta name="keywords" content="Wyrazy kluczowe" /> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="js/add.js"></script>

<title>Tytuł strony</title> 
</head> 
<body> 
        <header>
            <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'header.php'); ?>      
        </header>
        <section>
            <?php if(isset($Error))
                    echo $Error;
            ?>
            <h1>Utwórz post</h1><br>
            <form method="post" id="form" name="form" enctype="multipart/form-data">
                    <ul>
                        <li>
                            <label>Title</label> 
                            <input type="text" name="title" id="title" value=""><br>
                            <label class="error"></label>
                        </li>
                        <li id="preview">
                        </li>
                        
                        <li>
                            <label>Select file</label> 
                            <input type="file" id="file" name="file"><br>
                            <label class="error"></label>
                        </li>
                        <li>
                            <label>Description</label> 
                            <textarea name="description" id="description" rows="4" cols="50" value=''></textarea><br>
                            <label class="error"></label>

                        </li>
                        <li>
                            <input id="make" type="submit" value="Stwórz" name='make'>
                        </li>
                    </ul>
            </form>
            <form style="display:none" method="post" id="hidden" name="form" enctype="multipart/form-data">
                <input type="text" name="title" id="hiddentitle" value="" disabled=true>
                
            </form>
        </section>
        <footer>
            <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'footer.php'); ?>
        </footer>
</body> 
</html>
