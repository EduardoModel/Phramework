<?php
  declare(strict_types=1);

  namespace Phramework\core;

  /**
   * Responsible for handling the incoming requests
   */
  class Router {
    private const POST = 'post';
    private const GET = 'get';
    /** string[] */
    protected array $routes = [];

    /** Registers a get path with its callback */
    public function get(string $path, callable $callback): void
    {
      $this->routes[self::GET][$path] = $callback;
    }

    /** Registers a post path with its callback */
    public function post(string $path, callable $callback): void
    {
      $this->routes[self::POST][$path] = $callback;
    }
  }