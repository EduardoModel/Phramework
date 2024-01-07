<?php

declare(strict_types=1);

namespace Phramework\core;

interface Migration
{
  public function up(): void;
  public function down(): void;
}