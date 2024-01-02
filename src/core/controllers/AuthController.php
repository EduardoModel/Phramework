<?php
  declare(strict_types=1);

  namespace Phramework\core\controllers;

  use Phramework\core\Controller;
  use Phramework\core\Request;

  class AuthController extends Controller
  {
    public function login() 
    {
      return $this->render("login");
    }

    public function register(Request $request)
    {
      /**
       * I wouldn't overload the method here, since is always better to keep the logic
       * separated for the GET and POST methods
       */ 
      if($request->isPost()) {
        return 'Handle submitted data';
      }
      return $this->render('register');
    }
    
  }