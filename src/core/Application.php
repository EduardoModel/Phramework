<?php
  declare(strict_types=1);

  namespace Phramework\core;

  /**
   * Main entry point of the application
   */
  class Application
  {
    public Request $request;
    public Router $router;

    public function __construct()
    {
      $this->request = new Request();
      $this->router = new Router($this->request);
    }

    public function run(): void
    {
      $this->router->resolve();
    }
  }