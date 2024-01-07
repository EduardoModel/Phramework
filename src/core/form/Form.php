<?php

declare(strict_types=1);

namespace Phramework\core\form;

use Phramework\core\form\enums\FieldType;
use Phramework\core\http\Method;
use Phramework\core\Model;

class Form
{
  public static function begin(string $action, Method $method): self
  {
    echo '<form action="'.$action.'" method="'.$method->value.'">';
    return new self();
  }

  public static function end(): string
  {
    return '</form>';
  }

  public function field(Model $model, string $attribute, FieldType $type): Field
  {
    return new Field($model, $attribute, $type);   
  }
}