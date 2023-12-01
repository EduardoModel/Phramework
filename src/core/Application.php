<?php
  declare(strict_types=1);

  namespace Phramework\core;

  class Application
  {
    public function __construct(
      public Router $router
    )
    {
    }

    
  }