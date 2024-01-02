<?php
  declare(strict_types=1);

  namespace Phramework\core;

  class Controller
  {

    protected string $layout = 'main';
    protected function render(string $view, array $params = []): string 
    {
      return Application::$app->router->renderView($view, $params);
    }

    public function setLayout(string $layout): void
    {
      $this->layout = $layout;
    }
    public function getLayout(): string
    {
      return $this->layout;
    }
  }