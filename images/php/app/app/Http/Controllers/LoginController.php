<?php

namespace App\Http\Controllers;

use App\Login;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Services\LoginService;
use App\Services\RegisterService;

class LoginController extends Controller
{
    use ApiResponser;

    /**
    * The service to consume the login microservice
    * @var LoginService
    */
    public $loginService;

    /**
    * The service to consume the register microservice
    * @var RegisterService
    */
    public $registerService;

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(LoginService $loginService, RegisterService $registerService)
    {
        $this->loginService = $loginService;
        $this->registerService = $registerService;
    }

    /**
    * FRONT END
    * Fetch the login view
    * @return Illuminate\Http\Response
    */
    public function views(Request $request)
    {
        $session = $request->session();
        $session->put('auth','no');

        return $this->loginService->viewsLogin();
    }

    /**
    * BACK END
    * Return the list of users
    * @return Illuminate\Http\Response
    */
    public function index()
    {
        return $this->successResponse($this->loginService->obtainLogins());
    }

    /**
    * Create one new user
    * @return Illuminate\Http\Response
    */
    public function store(Request $request)
    {
       $check = $this->successResponse($this->loginService->
                          createLogin($request->all(),
                          Response::HTTP_CREATED
                          ));

      $session = $request->session();
      $session->put('auth','no');
      //$auth = $session->get('auth');

      //dd($check->content()[0]);
      $error = $this->errorResponse('Invalid Username or Password',
                  Response::HTTP_UNPROCESSABLE_ENTITY);

       if ($check->status() == 200 && $check->content()[0] != "<")
       {
         $session = $request->session();
         $session->put('auth','yes');
         // redirects if valid to billing page
          return redirect()->route('billings');
       } else {

          return redirect()->route('logins');
       }
    }

    /**
    * Obtains and shows one user
    * @return Illuminate\Http\Response
    */
    public function show($login)
    {
       return $this->successResponse($this->loginService->obtainLogin($login));
    }

    /**
    * Update an existing user
    * @return Illuminate\Http\Response
    */
    public function update(Request $request, $login)
    {
       return $this->successResponse($this->loginService->editLogin(
                                $request->all(), $login));
    }

    /**
    * Remove an existing user
    * @return Illuminate\Http\Response
    */
    public function destroy($login)
    {
       return $this->successResponse($this->loginService->deleteLogin($login));
    }
}
