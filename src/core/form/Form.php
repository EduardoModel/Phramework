<?php

declare(strict_types=1);

namespace Phramework\core\form;

use Phramework\core\Http\Method;

class Form
{
  public static function begin(string $action, Method $method): string
  {
    return '<form action="'.$action.'" method="'.$method->value.'">';
  }

  public static function end(): string
  {
    return '</form>';
  }
}