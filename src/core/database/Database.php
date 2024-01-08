<?php

declare(strict_types=1);

namespace Phramework\core\database;

use PDO;

class Database
{
  public PDO $db;


  public function __construct(string $dsn, string $user, string $password, array $options = [])
  { 
    $this->db = new PDO($dsn, $user, $password, $options);
    // If something went wrong just throw an exception
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}