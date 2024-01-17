<?php

  declare(strict_types=1);

  namespace Phramework\models;
  use Phramework\core\Model;


  class User extends Model
  {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirmation = '';

    public function rules(): array
    {
      return [
        'name' => [self::RULE_REQUIRED, [self::RULE_MIN_LENGTH, 'min' => 5]],
        'email'=> [self::RULE_REQUIRED, self::RULE_EMAIL],
        'password'=> [
          self::RULE_REQUIRED,
          [self::RULE_MIN_LENGTH, 'min' => 8],
          [self::RULE_MAX_LENGTH, 'max' => 255],  
        ],
        'passwordConfirmation'=> [
          self::RULE_REQUIRED,
          [self::RULE_MATCH, 'match' => 'password']
        ],
      ];
    }

    public function save(): User
    {
      return new self();
    }
  }