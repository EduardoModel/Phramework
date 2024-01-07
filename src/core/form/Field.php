<?php

declare(strict_types=1);

namespace Phramework\core\form;

use Phramework\core\Model;
use Stringable;

class Field implements Stringable
{
    public function __construct(
      public Model $model,
      public string $attribute
    )
    {
    }

    /**
     * Magic method that always will be called when the object
     * should be treated as string or echoed out
     */
    public function __toString(): string
    {
      return sprintf("
        <div class='form-group mb-3'>
            <label class='form-label' for='%s'>%s</label>
            <input type='text' name='%s' id='%s' value='%s' class='form-control %s'>
            <div class='invalid-feedback'>%s</div>
        </div>
      ",
      $this->attribute,
      $this->attribute,
      $this->attribute,
      $this->attribute,
      $this->model->{$this->attribute},
      $this->model->hasErrors($this->attribute) ? "is-invalid" : "",
      $this->model->getFirstError($this->attribute)
      );
    }
}