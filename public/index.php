<?php
  declare(strict_types=1);

  require_once __DIR__."/../vendor/autoload.php";

  use Dotenv\Dotenv;
  use Phramework\core\Application;
  use Phramework\controllers\AuthController;
  use Phramework\controllers\SiteController;
  use Phramework\core\database\DatabaseConfig;

  // Function dirname takes the directory of the passed down directory
  $dotenv = Dotenv::createImmutable(dirname(__DIR__));
  $dotenv->load();

  $databaseConfig = new DatabaseConfig(
    $_ENV["DB_DSN"] ?? '',
    $_ENV['DB_USER'] ??'',
    $_ENV['DB_PASSWORD'] ??''
  );

  $app = new Application(dirname(__DIR__)."/src", $databaseConfig);

  $app->router->get('/', [SiteController::class, 'home']);

  $app->router->get('/contact', [SiteController::class, 'index']);

  // Passing down the controller and the view to be used
  $app->router->post('/contact', [SiteController::class, 'create']);

  $app->router->get('/login', [AuthController::class, 'login']);
  $app->router->post('/login', [AuthController::class, 'login']);
  
  $app->router->get('/register', [AuthController::class, 'register']);
  $app->router->post('/register', [AuthController::class, 'register']);

  $app->run();