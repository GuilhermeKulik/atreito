                                            
<?php
// Pega o erro da url via get
$m = isset($_GET['m']) ? urldecode($_GET['m']) : null;
$alertClass = isset($_GET['a']) ? urldecode($_GET['a']) : null;

if ($m) : 
?>
    <div class="alert alert-<?php echo $alertClass?>" role="alert">
        <?php echo $m; ?>
            <?php $m = null; ?>
    </div>
<?php endif; ?>