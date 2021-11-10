        <section>
            <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'alert.php'); ?> 
            <h1>Użytkownicy</h1>
        <table>
                <tr>
                <td>Id</td>
                <td>Imie</td>
                <td>Nazwisko</td>
                <td>Login</td>
                <td>Wiek</td>
                <td>Uprawnienia</td>
                <td>Akcja</td>
            </tr>
            <?php
               while ($user = $stmt->fetch()) {
                   echo "<tr>";
                   echo "<td>".$user['id']."</td>";
                   echo "<td>".$user['name']."</td>";
                   echo "<td>".$user['surname']."</td>";
                   echo "<td>".$user['login']."</td>";
                   echo "<td>".$user['age']."</td>";
                   echo "<td>".$user['permission']."</td>";
                   echo "<td><a href=\"index.php?action=users&id={$user['id']}&do=edit\">edytuj</a><br><a href=\"index.php?action=users&id={$user['id']}&do=delete\">usuń</a><br><a href=\"index.php?action=users&id={$user['id']}&do=view\">książki</a></td>";
                   echo "</tr>";
               }

            ?>
        </table>
        </section>