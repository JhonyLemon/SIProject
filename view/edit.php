<?php if(isset($_GET['id'])): ?>
<form method="post" action="index.php?action=users&id=<?php echo $_GET['id'] ?>&do=edit" id="editPoints" name="Edit">
    <input type="number" name="points" value="<?php echo $points['points'] ?>"> 
    <input type="submit" name="edit" value="Aktualizuj">
</form>
<?php else: ?>
    <?php redirect('users'); ?>
<?php endif; ?>