<?php

  declare(strict_types=1);

  namespace Phramework\models;
  use Phramework\core\Request;

  class RegisterModel
  {

    public string $name;
    public string $email;
    public string $password;
    public string $passwordConfirmation;
    
    public function loadData(Request $request): void
    {}

    public function validate(): void
    {}

    public function save(): RegisterModel
    {
      return new self();
    }
  }