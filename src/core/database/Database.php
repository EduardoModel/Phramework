<?php

declare(strict_types=1);

namespace Phramework\core\database;

use PDO;
use Phramework\core\Application;
use Phramework\core\Migration;

class Database
{
  public PDO $db;


  public function __construct(string $dsn, string $user, string $password, array $options = [])
  { 
    $this->db = new PDO($dsn, $user, $password, $options);
    // If something went wrong just throw an exception
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function applyMigrations(): void
  {
    // Create migrations table, if not defined
    $this->createMigrationsTable();

    // Get all migration files that were already migrated
    $appliedMigrations = $this->getAppliedMigrations(); 

    // Scan dir for the migration files
    $migrationFiles = scandir(Application::$rootPath."/migrations");

    $migrationsToApply = array_diff($migrationFiles, $appliedMigrations);

    $newMigrations = [];
    foreach($migrationsToApply as $migration) {
      if($migration === "." || $migration === "..") {
        continue;
      }
      
      require_once Application::$rootPath."/migrations/".$migration;

      $className = pathinfo($migration, PATHINFO_FILENAME);
      
      // Fully qualified name is required!
      /** @var Migration */
      $instance = new ("Phramework\migrations\\".$className)();
      
      $this->log("Applying migration {$migration}");
      $instance->up();
      $this->log("Applied migration {$migration}");
      $newMigrations[] = $migration;
    }

    if(!empty($newMigrations)) {
      $this->saveMigrations($newMigrations);
    } else {
      $this->log("All migrations were applied");
    }
  }

  public function dropMigrations(): void
  {
    // Need to iterate from the latest to the oldest
    $appliedMigrations = array_reverse($this->getAppliedMigrations()); 

    foreach($appliedMigrations as $migration) {
      if($migration === "." || $migration === "..") {
        continue;
      }
      
      require_once Application::$rootPath."/migrations/".$migration;

      $className = pathinfo($migration, PATHINFO_FILENAME);
      
      // Fully qualified name is required!
      /** @var Migration */
      $instance = new ("Phramework\migrations\\".$className)();
      
      $this->log("Reverting migration {$migration}");
      $instance->down();
      $this->log("Reverting migration {$migration}");
    }

    $this->log("Dropping migrations table");
    $this->dropMigrationsTable();
    $this->log("Dropped migrations table");
  }

  private function createMigrationsTable(): void
  {
    $this->db->exec("
      CREATE TABLE IF NOT EXISTS migrations (
        id SERIAL PRIMARY KEY,
        migration VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      ) ENGINE=INNODB;
    ");
  }

  private function getAppliedMigrations(): array
  {
    $sth = $this->db->prepare("
      SELECT
        migration
      FROM
        migrations
    ");

    $sth->execute();
  
    return $sth->fetchAll(PDO::FETCH_COLUMN);
  }

  private function dropMigrationsTable(): void
  {
    $sth = $this->db->prepare("
      DROP TABLE migrations;
    ");

    $sth->execute();
  }

  private function saveMigrations(array $migrations): void
  {
    $migrationsToSave = implode(',', array_map(fn($m) => "('$m')", $migrations));

    $sth = $this->db->prepare("
      INSERT INTO migrations (migration) VALUES
      {$migrationsToSave}
    ");

    $sth->execute();
  }

  private function log(string $message): void
  {
    echo "[". date("Y-m-d H:i:s") . "] - " . $message . PHP_EOL;
  }
}