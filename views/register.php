<?php
// Form::begin() will output the <form> opening tag
// and will return an instance of the Form class,
// which we will store in the $form variable,
// so that we can chain methods.
// Form::end() will output the </form> closing tag
use app\core\form\Form;

?>

<h1>Create an account</h1>

<?php $form = Form::begin("", "post"); ?>
    <div class="row">
        <div class="col">
            <?php echo $form->field($model, 'firstName') ?>
        </div>
        <div class="col">
            <?php echo $form->field($model, 'lastName') ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php echo $form->field($model, "password")->passwordField(); ?>
        </div>
        <div class="col">
            <?php echo $form->field($model, "confirmPassword")->passwordField(); ?>
        </div>
    </div>
    <?php echo $form->field($model, "email"); ?>

    <button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>
