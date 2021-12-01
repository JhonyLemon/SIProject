<?php if (isset($_GET['id']) && $user) : ?>
    <div class="center">
        <fieldset>
            <h4>Czy na pewno chcesz usunąć użytkownika???</h4>
            <form class="select" method="post" action="index.php?action=users&id=<?php echo $_GET['id'] ?>&do=delete" id="editPoints" name="Delete">
                <input type="submit" name="delete" value="Usuń">
            </form>
            <form class="select" method="post" action="index.php?action=users">
                <input type="submit" name="cancel" value="Anuluj">
            </form>
        </fieldset>
    </div>
<?php else : ?>
    <?php redirect('users'); ?>
<?php endif; ?>