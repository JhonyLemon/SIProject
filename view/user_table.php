<table class="users">
        <tr>
                <th>Id</th>
                <th>Login</th>
                <th>E-mail</th>
                <th>Birthday</th>
                <th>Permission</th>
                <th>Points</th>
                <th>Actions</th>
        </tr>
        <?php while ($user = $stmt->fetch()) : ?>
                <tr>
                        <td><?php echo $user['IDuser']; ?></td>
                        <td><?php echo $user['login']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['birthday']; ?></td>
                        <td><?php echo $user['permission']; ?></td>
                        <td><?php echo $user['points']; ?></td>
                        <td>
                                <a href="index.php?action=users&id=<?php echo $user['IDuser']; ?>&do=view">Zobacz posty</a><br>
                                <a href="index.php?action=users&id=<?php echo $user['IDuser']; ?>&do=delete">Usuń</a><br>
                                <a href="index.php?action=users&id=<?php echo $user['IDuser']; ?>&do=edit">Edytuj punkty</a>
                        </td>
                </tr>
        <?php endwhile; ?>
</table>