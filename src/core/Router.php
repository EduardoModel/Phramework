<?php
  declare(strict_types=1);

  namespace Phramework\core;

  /**
   * Responsible for handling the incoming requests
   */
  class Router
  {
    private const POST = 'post';
    private const GET = 'get';

    private const LAYOUT_CONTENT = "{{content}}";
    
    protected array $routes = [];

    public function __construct(
      private Request $request,
    )
    {
    }

    /** Registers a get path with its callback */
    public function get(string $path, callable|string $callback): void
    {
      $this->routes[self::GET][$path] = $callback;
    }

    /** Registers a post path with its callback */
    public function post(string $path, callable|string $callback): void
    {
      $this->routes[self::POST][$path] = $callback;
    }

    public function resolve(): string
    {
      $path = $this->request->getPath();
      $method = $this->request->getMethod();

      $callback = $this->routes[$method][$path] ?? false;
      
      if(!$callback) {
        return "Not found";
      }

      if(is_string($callback)) {
        return $this->renderView($callback);
      }

      return call_user_func($callback);
    }

    private function renderView(string $view): string
    {
      $layoutContent = $this->getLayoutContent();
      $viewContent = $this->renderViewOnly($view);
      return str_replace(self::LAYOUT_CONTENT, $viewContent, $layoutContent);
    }

    protected function getLayoutContent(): string
    {
      // Starts output caching
      ob_start();
      include_once Application::$rootPath."/views/layouts/main.php";
      // Returns the contents inside the caching and clear it
      return ob_get_clean();
    }

    protected function renderViewOnly(string $view): string
    {
      ob_start();
      include_once Application::$rootPath."/views/{$view}.php";
      return ob_get_clean();
    }
  }