<?php
  declare(strict_types=1);

  namespace Phramework\core;

  class Response
  {
    public const NOT_FOUND = 404;

    public function setStatusCode(int $statusCode): void
    {
      http_response_code($statusCode);
    }
  }