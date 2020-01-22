<?php

namespace App\Http\Controllers;

use App\Login;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Services\LoginService;
use App\Services\RegisterService;
use App\Services\BillingService;

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
    * The service to consume the billing microservice
    * @var BillingService
    */
    public $billingService;

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(LoginService $loginService, RegisterService $registerService, BillingService $billingService)
    {
        $this->loginService = $loginService;
        $this->registerService = $registerService;
        $this->billingService = $billingService;
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

       $error = $this->errorResponse('Invalid Username or Password',
                   Response::HTTP_UNPROCESSABLE_ENTITY);

       if ($check->status() == 200 && $check->content()[0] != "<")
       {
           /**
           * Get the registers to find the counts and query every user on it
           **/
           $user_register = $this->registerService->obtainRegisters();
           $user_register = json_decode($user_register, true);
           $user_register = array_shift($user_register);

           /**
           * Get the billings to find if the user already has a billing
           **/
           $user_billing = $this->billingService->obtainBillings();
           $user_billing = json_decode($user_billing, true);
           $user_billing = array_shift($user_billing);

           /**
           * Find the username of login and save the registered id in sessions
           **/
           $user_login = json_decode($check->original, true);
           $user_login = array_shift($user_login);

           $session = $request->session();
           $session->put('auth','yes');

           for($counter = 0; $counter < count($user_register); $counter++){
               if ($user_register[$counter]['username']  == $user_login['username']){

                      $session->put('user_id', $user_register[$counter]['id'] );
              }
           }

           $user = $session->get('user_id');
           if($user <= count($user_billing)){

               return redirect()->route('billings_exist',[
                          'billings_exist' => $user,
               ]);
           } else{

               return redirect()->route('billings');
           }
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
