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
        <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'alert.php'); ?>  
            <h1>Książki</h1>
            <table>
                <tr>
                <td>Id</td>
                <td>Title</td>
                <td>Authors</td>
                <td>Number</td>
                <td>Akcja</td>
            </tr>
            <?php
               while ($book = $stmt->fetch()) {
                   echo "<tr>";
                   echo "<td>".$book['id']."</td>";
                   echo "<td>".$book['title']."</td>";
                   echo "<td>".$book['authors']."</td>";
                   echo "<td>".$book['number']."</td>";
                   if($book['number']>0 && !in_array($book['id'],array_column($user_books, 'idbook')))
                   echo "<td><a href=\"index.php?action=books&id={$book['id']}\">pożycz</a></td>";
                   echo "</tr>";
               }

            ?>
        </table>
        </section>
        <footer>
            <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'footer.php'); ?>
        </footer>
</body> 
</html>