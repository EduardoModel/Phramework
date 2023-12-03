<?php
  declare(strict_types=1);

  namespace Phramework\core;

  class Request
  {

    public const GET = "get";
    public const POST = "post";

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
      return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getBody(): string
    {}
  }