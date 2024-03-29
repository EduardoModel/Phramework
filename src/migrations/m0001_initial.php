<?php

declare(strict_types=1);

namespace Phramework\migrations;

use Phramework\core\Application;
use Phramework\core\Migration;

class m0001_initial implements Migration
{
  public function up(): void
  {
    $database = Application::$app->database;
    $database->db->exec("
      CREATE TABLE users (
        id SERIAL PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        name VARCHAR(255) NOT NULL,
        status TINYINT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      ) ENGINE=INNODB;
    ");
  }

  public function down(): void
  {
    $database = Application::$app->database;
    $database->db->exec("
      DROP TABLE users;
    ");
  }
}