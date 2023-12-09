<?php
  declare(strict_types=1);

  namespace Phramework\core;

  /**
   * Responsible for handling the incoming requests
   */
  class Router
  {
    private const LAYOUT_CONTENT = "{{content}}";
    
    protected array $routes = [];

    public function __construct(
      private Request $request,
      private Response $response,
    )
    {
    }

    /** Registers a get path with its callback */
    public function get(string $path, callable|string $callback): void
    {
      $this->routes[Request::GET][$path] = $callback;
    }

    /** Registers a post path with its callback */
    public function post(string $path, callable|string|array $callback): void
    {
      $this->routes[Request::POST][$path] = $callback;
    }

    public function resolve(): string
    {
      $path = $this->request->getPath();
      $method = $this->request->getMethod();

      $callback = $this->routes[$method][$path] ?? false;
      
      if(!$callback) {
        $this->response->setStatusCode(Response::NOT_FOUND);
        return $this->renderView("not-found");
      }

      if(is_string($callback)) {
        return $this->renderView($callback);
      }

      /*
        For this function call is also possible to pass down an array containing
        the class with the respective method that needs to be called
        For now the way that it works is using static methods, otherwise php throws an error
        Ex.: [UserController::class, 'create']
      */
       return call_user_func($callback);
    }

    public function renderView(string $view): string
    {
      $layoutContent = $this->getLayoutContent();
      $viewContent = $this->renderViewOnly($view);
      return str_replace(self::LAYOUT_CONTENT, $viewContent, $layoutContent);
    }
    public function renderViewOnly(string $view): string
    {
      ob_start();
      include_once Application::$rootPath."/views/{$view}.php";
      return ob_get_clean();
    }

    protected function getLayoutContent(): string
    {
      // Starts output caching
      ob_start();
      include_once Application::$rootPath."/views/layouts/main.php";
      // Returns the contents inside the caching and clear it
      return ob_get_clean();
    }
  }