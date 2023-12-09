<?php
  declare(strict_types=1);

  namespace Phramework\core;

  class Controller
  {
    protected function render(string $view, array $params = []): string 
    {
      return Application::$app->router->renderView($view, $params);
    }
  }