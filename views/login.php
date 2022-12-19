<?php

/**
 * @var $model app\models\User
 */

use app\core\form\Form;

?>

<h1>Log in to the system</h1>

<?php $form = Form::begin("", "post"); ?>
<?php echo $form->field($model, "email"); ?>
<?php echo $form->field($model, "password")->passwordField(); ?>

<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>