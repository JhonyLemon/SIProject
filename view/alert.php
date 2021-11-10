        <?php if (isset($alert)): ?> 
        <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span><?php echo $alert ?></div>
        <?php elseif(isset($ok)): ?>
        <div class="ok"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span><?php echo $ok ?></div><?php endif; ?>