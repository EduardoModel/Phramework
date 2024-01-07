<h1>Register</h1>
<?php
  /**
   * This approach solves the issue with the overwhelming usage of 
   * php tags within the php. However: it is a very restrictive solution from the html
   * and styling side of things
   */
  $form = Phramework\core\form\Form::begin('', Phramework\core\Http\Method::POST);
   echo $form->field($model, 'name');
   echo $form->field($model, 'email');
   echo $form->field($model, 'password');
   echo $form->field($model, 'passwordConfirmation');
?>
<button class="btn btn-primary" type="submit">Submit</button>
<?php echo Phramework\core\form\Form::end(); ?>