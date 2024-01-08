<?php

declare(strict_types=1);

namespace Phramework\core\database;

class DatabaseConfig
{
  public function __construct(
    private readonly string $dsn,
    private readonly string $user,
    private readonly string $password
  )
  {
  }

  public function getDsn(): string
  {
    return $this->dsn;
  }

  public function getUser(): string
  {
    return $this->user;
  }

  public function getPassword(): string
  {
    return $this->password;
  }
}