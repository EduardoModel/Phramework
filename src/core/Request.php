<?php
  declare(strict_types=1);

  namespace Phramework\core;

  class Request
  {
    public function getPath(): string
    {
      $requestPath = $_SERVER['REQUEST_URI'] ?? "/";
      $questionMarkPosition = strpos($requestPath, '?');

      if(!$questionMarkPosition) {
        return $requestPath;
      }
      return substr($requestPath, 0, $questionMarkPosition);
    }

    public function getMethod(): string
    {

    }

    public function getBody(): string
    {}
  }