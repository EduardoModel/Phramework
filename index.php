<?php
  declare(strict_types=1);

  namespace Phramework\core;
  
  $app = new Application();

  $app->router->get('/', function() {
    return 'Hello world';
  });

  $app->run();