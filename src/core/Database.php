<?php

declare(strict_types=1);

namespace Phramework\core;

use PDO;

class Database
{
  public PDO $db;


  public function __construct(): void
  {
    
    $this->db = new PDO($dsn, $user, $password);
    // If something went wrong just throw an exception
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}