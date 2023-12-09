<?php
  declare(strict_types=1);

  namespace Phramework\core\controllers;

  use Phramework\core\Application;
  use Phramework\core\Controller;
  
  class SiteController extends Controller
  {
    // This methods will be called by the router and then within their own scopes
    public function index(): string
    {
      return $this->render('contact');
    }

    public function create(): string
    {
      echo "Handling submitted data";
      return "";  
    }

    public function home(): string
    {
      $params = [
        'name' => 'El testador'
      ];
      return $this->render('home', $params);
    }
  }