<?php

declare(strict_types=1);

namespace Phramework\migrations;

use Phramework\core\Application;
use Phramework\core\Migration;

class m0002_add_field_password_to_users_table implements Migration
{
  public function up(): void
  {
    $database = Application::$app->database;
    $database->db->exec("
      ALTER TABLE users
      ADD COLUMN password varchar(512) NOT NULL;
    ");
  }

  public function down(): void
  {
    $database = Application::$app->database;
    $database->db->exec("
      ALTER TABLE users
      DROP COLUMN password;
    ");
  }
}