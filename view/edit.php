<?php if (isset($_GET['id'])) : ?>
    <div class="center">
        <fieldset>
            <h4>Edytuj ilość punktów użytkownika</h4>
            <form class="select" method="post" action="index.php?action=users&id=<?php echo $_GET['id'] ?>&do=edit" id="editPoints" name="Edit">
                <input type="number" name="points" value="<?php echo $points['points'] ?>">
                <input type="submit" name="edit" value="Aktualizuj">
            </form>
        </fieldset>
    </div>
<?php else : ?>
    <?php redirect('users'); ?>
<?php endif; ?>