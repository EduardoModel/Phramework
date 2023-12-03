<?php
  declare(strict_types=1);

  namespace Phramework\core;

  /**
   * Main entry point of the application
   */
  class Application
  {
    public static string $rootPath;


    public Request $request;
    public Router $router;

    public function __construct(
      string $rootPath
    )
    {
      // Root path is to make imports more easy and concise across the application
      self::$rootPath = $rootPath;
      $this->request = new Request();
      $this->router = new Router($this->request);
    }

    public function run(): void
    {
      echo $this->router->resolve();
    }
  }