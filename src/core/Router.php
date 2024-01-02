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
    public function get(string $path, callable|string|array $callback): void
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
      $method = $this->request->method();

      $callback = $this->routes[$method][$path] ?? false;
      
      if(!$callback) {
        $this->response->setStatusCode(Response::NOT_FOUND);
        return $this->renderView("not-found");
      }

      if(is_string($callback)) {
        return $this->renderView($callback);
      }

      if(is_array($callback)) {
        // TODO: here we'll need some DI/DIC shenanigans while instantiating the controller
        $callback[0] = new $callback[0];
      }

      /**
       * For this function call is also possible to pass down an array containing
       * the class with the respective method that needs to be called
       * For now the way that it works is using static methods, otherwise php throws an error
       * Ex.: [UserController::class, 'create']
       * 
       * It is also possible to inform the arguments for a given method in order for it to work as a second argument
       */
       return call_user_func($callback, $this->request);
    }

    public function renderView(string $view, array $params = []): string
    {
      $layoutContent = $this->getLayoutContent();
      $viewContent = $this->renderViewOnly($view, $params);
      return str_replace(self::LAYOUT_CONTENT, $viewContent, $layoutContent);
    }
    public function renderViewOnly(string $view, array $params): string
    {
      // #Magic-step!
      /**
       * Here will be defined all the variables passed down via params
       * so the view have them available while rendering
       */
      foreach($params as $key => $value) {
        // Using the double dollar sign symbol is possible to create a variable with
        // the value contained inside the $key 
        $$key = $value;
      }

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