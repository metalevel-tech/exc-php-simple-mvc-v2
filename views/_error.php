<?php

/** 
 * @var \Exception $exception
 * @var \app\core\View $this 
 */

$this->title = $exception->getCode();
?>

<h1>HTTP <?php echo $exception->getCode() ?></h1>
<p><?php echo $exception->getMessage() ?></p>

