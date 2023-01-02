<?php

/** @var $exception \Exception */
?>
<h1>HTTP <?php echo $exception->getCode() ?></h1>
<p><?php echo $exception->getMessage() ?></p>
