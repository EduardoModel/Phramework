<?php
  declare(strict_types=1);

  namespace Phramework\core;

  /**
   * Main entry point of the application
   */
  class Application
  {
    public function __construct(
      public Router $router = new Router()
    )
    {
    }

    public function run(): void
    {
      // TODO implement this method
    }
  }