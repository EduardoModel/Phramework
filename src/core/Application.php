<?php
  declare(strict_types=1);

  namespace Phramework\core;

  /**
   * Main entry point of the application
   */
  class Application
  {
    public static string $rootPath;

    public Request $request;
    public Response $response;

    public Router $router;

    public static Application $app;

    public function __construct(
      string $rootPath
    )
    {
      // Root path is to make imports more easy and concise across the application
      self::$rootPath = $rootPath;
      // This step here is necessary to make the Application instance accessible across all the application 
      // I personally don't find this approach secure nor elegant; 
      self::$app = $this;
      $this->request = new Request();
      $this->response = new Response();
      $this->router = new Router($this->request, $this->response);
    }

    public function run(): void
    {
      echo $this->router->resolve();
    }
  }