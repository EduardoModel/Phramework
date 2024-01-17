<?php
  declare(strict_types=1);

  namespace Phramework\controllers;

  use Phramework\core\Controller;
  use Phramework\models\User;
  use Phramework\core\Request;
  use Phramework\core\Response;

  class AuthController extends Controller
  {

    public function __construct() {
      $this->setLayout("auth");
    }

    public function login(Request $request, Response $response) 
    {
      if($request->isPost()) {
        echo "post received!";
        $response->setStatusCode(Response::NOT_FOUND);
      }
      return $this->render("login");
    }

    public function register(Request $request)
    {
      /**
       * I wouldn't overload the method here, since is always better to keep the logic
       * separated for the GET and POST methods
       */ 
      $user = new User();
      if($request->isPost()) {
        $user->loadData($request->getBody());

        $user->validate();

        if($user->validate()) {
          $user->save();
          return "Yaayy";
        }
      }
      return $this->render('register', [
        'model' => $user
      ]);
    }
    
  }