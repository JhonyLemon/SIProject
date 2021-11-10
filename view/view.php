        <section>
            <h1>Użytkownicy</h1>
        <table>
                <tr>
                <td>Id</td>
                <td>Tytuł</td>
                <td>Autor</td>
            </tr>
            <?php
               while ($books = $stmt->fetch()) {
                    echo "<tr>";
                    echo "<td>".$books['id']."</td>";
                    echo "<td>".$books['title']."</td>";
                    echo "<td>".$books['authors']."</td>";
                    echo "</tr>";
               }

            ?>
        </table>
        </section>