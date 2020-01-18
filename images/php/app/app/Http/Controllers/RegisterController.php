<?php

namespace App\Http\Controllers;

use App\Register;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Services\RegisterService;

class RegisterController extends Controller
{
    use ApiResponser;

    /**
    * The service to consume the login microservice
    * @var RegisterService
    */
    public $registerService;

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    /**
    * FRONT END
    * Fetch the register view
    * @return Illuminate\Http\Response
    */
    public function views()
    {
        return $this->registerService->viewsRegister();
    }

    /**
    * BACK END
    * Return the list of users
    * @return Illuminate\Http\Response
    */
    public function index()
    {
        return $this->successResponse($this->registerService->obtainRegisters());
    }

    /**
    * Create one user
    * @return Illuminate\Http\Response
    */
    public function create(Request $request)
    {
       return $this->successResponse($this->registerService->
                          createRegi($request->all(),
                          Response::HTTP_CREATED
                          ));
    }

    /**
    * Create one new user
    * @return Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $check = $this->successResponse($this->registerService->
                          createRegister($request->all(),
                          Response::HTTP_CREATED
                        ));

         if ($check->status() == 200)
         {
           // redirects if registered to login page
            return redirect()->route('logins');
         }
    }

    /**
    * Obtains and shows one user
    * @return Illuminate\Http\Response
    */
    public function show($register)
    {
       return $this->successResponse($this->registerService->obtainRegister($register));
    }

    /**
    * Update an existing user
    * @return Illuminate\Http\Response
    */
    public function update(Request $request, $register)
    {
       return $this->successResponse($this->registerService->editRegister(
                                $request->all(), $register));
    }

    /**
    * Remove an existing user
    * @return Illuminate\Http\Response
    */
    public function destroy($register)
    {
       return $this->successResponse($this->registerService->deleteRegister($register));
    }
}
