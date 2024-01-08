<?php
  declare(strict_types=1);

  require_once __DIR__."/vendor/autoload.php";

  use Dotenv\Dotenv;
  use Phramework\core\Application;
  use Phramework\core\database\DatabaseConfig;

  // Function dirname takes the directory of the passed down directory
  $dotenv = Dotenv::createImmutable(__DIR__);
  $dotenv->load();

  $databaseConfig = new DatabaseConfig(
    $_ENV["DB_DSN"] ?? '',
    $_ENV['DB_USER'] ??'',
    $_ENV['DB_PASSWORD'] ??''
  );

  $app = new Application(__DIR__."/src", $databaseConfig);

  $app->database->applyMigrations();