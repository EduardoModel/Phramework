<?php
  declare(strict_types=1);

  require_once __DIR__."/vendor/autoload.php";

  define("MIGRATION_UP", "up");
  define("MIGRATION_DOWN", "down");

  if(!isset($argv[1]) || $argv[1] === "") {
    echo "[ERROR] - Missing up or down param" . PHP_EOL;
    exit(1);
  }
  
  $migrationCommand = strtolower($argv[1]);

  if($migrationCommand != MIGRATION_UP && $migrationCommand != MIGRATION_DOWN) {
    echo "[ERROR] - Invalid param; Expected either " . MIGRATION_UP . " or " . MIGRATION_DOWN . ", {$migrationCommand} received". PHP_EOL;
    exit(1);
  }

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

  if($migrationCommand === MIGRATION_UP) {
    $app->database->applyMigrations();
  }
  else {
    $app->database->dropMigrations();
  }