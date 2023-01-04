<?php
/**
 * @var \app\models\User $user
 * @var \app\core\View $this 
 */ 

$this->title = "Profile";
?>

<h1>Profile</h1>
<p>The profile page of <?php echo $user->getDisplayName() ?>!</p>