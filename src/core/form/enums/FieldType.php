<?php

declare(strict_types=1);

namespace Phramework\core\form\enums;

enum FieldType: string
{
  case TEXT = "text";
  case PASSWORD = "password";
  case EMAIL = "email";
  case DATE = "date";
}