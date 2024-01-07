<h1>Register</h1>
<?php
  /**
   * This approach solves the issue with the overwhelming usage of 
   * php tags within the php. However: it is a very restrictive solution from the html
   * and styling side of things
   */
  $form = Phramework\core\form\Form::begin('', Phramework\core\http\Method::POST);
   echo $form->field($model, 'name', Phramework\core\form\enums\FieldType::TEXT);
   echo $form->field($model, 'email', Phramework\core\form\enums\FieldType::EMAIL);
   echo $form->field($model, 'password', Phramework\core\form\enums\FieldType::PASSWORD);
   echo $form->field($model, 'passwordConfirmation', Phramework\core\form\enums\FieldType::PASSWORD);
?>
<button class="btn btn-primary" type="submit">Submit</button>
<?php echo Phramework\core\form\Form::end(); ?>