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

    public function method(): string
    {
      return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(): bool
    {
      return $this->method() === self::GET;
    }

    public function isPost(): bool
    {
      return $this->method() === self::POST;
    }

    // This method will be mainly responsible for sanitizing the received data
    public function getBody(): array
    {
      $body = [];
      
      if($this->method() === self::GET) {
        foreach($_GET as $key => $value) {
          // The function filter_input allow to filter out invalid/malicious/undesired characters from the payload
          $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
      }

      if($this->method() === self::POST) {
        foreach($_POST as $key => $value) {
          // The function filter_input allow to filter out invalid/malicious/undesired characters from the payload
          $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
      }

      return $body;
    }
  }