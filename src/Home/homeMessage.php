<?php if(!defined('directAccessValidator')) { die(file_get_contents('../../includes/notFound.php')); return; } ?>

<?php
if(isset($_SESSION['message']))
{ ?>
    <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['message'] ?>
    </div>
<?php  } unset($_SESSION['message']); ?>