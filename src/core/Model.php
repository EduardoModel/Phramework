<?php

declare(strict_types=1);

namespace Phramework\core;

abstract class Model
{
  public const RULE_REQUIRED = 'Required';
  public const RULE_OPTIONAL = 'Optional';
  public const RULE_EMAIL = 'Email';
  public const RULE_MIN_LENGTH = 'Min length';
  public const RULE_MAX_LENGTH = 'Max length';
  public const RULE_MATCH = 'Match';
  public const RULE_UNIQUE = 'Unique';

  private array $errors = [];
  
  private function addError(string $attribute, string $rule): void
  {
    $errorMessage = $this->getErrorMessage($rule);
    
    $this->errors[$attribute][] = $this->getErrorMessage($rule);
  }

  // In the future it can be changed with enum class for better type hinting!
  private function getErrorMessage(string $rule): string
  {
    return match($rule) {
      self::RULE_REQUIRED => 'This field is required',
      self::RULE_EMAIL => 'This field must be a valid email',
      self::RULE_MIN_LENGTH => 'Min length of this field must be {min}',
      self::RULE_MAX_LENGTH => 'Max length of this field must be {max}',
      self::RULE_MATCH => 'This field must be the same as {match}',
      default => '',
    };
  }

  public function getErrors(): array
  {
    return $this->errors;
  }

  public function loadData(array $data): void
  {
    foreach ($data as $key => $value) {
      // Verify if the key exists within the model
      if(property_exists($this, $key)) {
        // If so, assign it to the attribute
        $this->$key = $value;
      }
    }
  }

  abstract public function rules(): array;

  public function validate(): bool
  {
    foreach ($this->rules() as $attribute => $rules) {
      // Get the name of the attributes to be checked
      $value = $this->$attribute;

      foreach($rules as $rule) {
        $ruleName = $rule;
        if(!is_string($ruleName)) {
          $ruleName = $rule[0];
        }
        if($ruleName === self::RULE_REQUIRED && !$value) {
          $this->addError($attribute, self::RULE_REQUIRED);
        }
        if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
          $this->addError($attribute, self::RULE_EMAIL);
        }
        if($ruleName === self::RULE_MAX_LENGTH && strlen($value) > $rule['max']) {
          $this->addError($attribute, self::RULE_MAX_LENGTH);
        }
        if($ruleName === self::RULE_MIN_LENGTH && strlen($value) < $rule['min']) {
          $this->addError($attribute, self::RULE_MIN_LENGTH);
        }
      }
    }

    return !count($this->getErrors());
  }
}