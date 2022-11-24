<?php
// Form::begin() will output the <form> opening tag
// and will return an instance of the Form class,
// which we will store in the $form variable,
// so that we can chain methods.
// Form::end() will output the </form> closing tag
use app\core\form\Form;

?>

<h1>Log in to the system</h1>

<?php $form = Form::begin("", "post"); ?>
    <?php echo $form->field($model, "email"); ?>
    <?php echo $form->field($model, "password")->passwordField(); ?>

    <button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>