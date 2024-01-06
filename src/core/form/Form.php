<?php

declare(strict_types=1);

namespace Phramework\core\form;

class Form
{
  public static function begin(string $action, string $method): string
  {
    return '<form action="'.$action.'" method="'.$method.'">';
  }

  public static function end(): string
  {
    return '</form>';
  }
}