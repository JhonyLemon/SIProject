<?php if(isset($_GET['id']) && $user): ?>
<form method="post" action="index.php?action=users&id=<?php echo $_GET['id'] ?>&do=delete" id="editPoints" name="Delete">
    <input type="submit" name="delete" value="Usuń">
</form>
<?php else: ?>
    <?php redirect('users'); ?>
<?php endif; ?>