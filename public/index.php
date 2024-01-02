<?php
  declare(strict_types=1);

  require_once __DIR__."/../vendor/autoload.php";

  use Phramework\core\Application;
  use Phramework\core\controllers\AuthController;
  use Phramework\core\controllers\SiteController;

  $app = new Application(dirname(__DIR__)."/src/core");

  $app->router->get('/', [SiteController::class, 'home']);

  $app->router->get('/contact', [SiteController::class, 'index']);

  // Passing down the controller and the view to be used
  $app->router->post('/contact', [SiteController::class, 'create']);

  $app->router->get('/login', [AuthController::class, 'login']);
  $app->router->post('/login', [AuthController::class, 'login']);
  
  $app->router->get('/register', [AuthController::class, 'register']);
  $app->router->post('/register', [AuthController::class, 'register']);

  $app->run();