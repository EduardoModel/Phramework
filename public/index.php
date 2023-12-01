<?php
  declare(strict_types=1);

  require_once __DIR__."/../vendor/autoload.php";

  use Phramework\core\Application;
  
  $app = new Application();

  $app->router->get('/', 'home');

  $app->router->get('/contact', 'contact');

  $app->run();