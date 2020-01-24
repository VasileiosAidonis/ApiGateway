<?php

namespace App\Http\Controllers;


use App\Billing;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Services\BillingService;
use App\Services\LoginService;
use Illuminate\Support\Facades\Config;


class BillingController extends Controller
{
    use ApiResponser;

    /**
    * The service to consume the billings microservice
    * @var BillingService
    */
    public $billingService;

    /**
    * The service to consume the logins microservice
    * @var LoginService
    */
    public $loginService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BillingService $billingService, LoginService $loginService)
    {
        $this->billingService = $billingService;
        $this->loginService = $loginService;
    }

    /**
    * FRONT END
    * Fetch the billing view
    * @return Illuminate\Http\Response
    */
    public function views(Request $request)
    {
        $session = $request->session();
        $auth = $session->get('auth');

        if($auth == 'yes'){

            return $this->billingService->viewsBilling();
        } else {

            return redirect()->route('logins');
        }
    }

    /**
    * Fetch the billings_exist view
    * @return Illuminate\Http\Response
    */
    public function views_exist(Request $request, $billing)
    {
        $session = $request->session();
        $auth = $session->get('auth');

        if($auth == 'yes'){

           return $this->billingService->viewsBilling_exist($billing);
        } else {

           return redirect()->route('logins');
        }
    }

    /**
    * BACK END
    * Return the list of billings
    * @return Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $session = $request->session();
        $user_username = $session->get('user_username');

        return redirect()->route('catalogues', ['catalogue' => $user_username ]);

        return $this->successResponse($this->billingService->obtainBillings());
    }

    /**
    * Create a billing
    * @return Illuminate\Http\Response
    */
    public function create(Request $request)
    {
      $session = $request->session();
      $user_username = $session->get('user_username');

      return redirect()->route('catalogues', ['catalogue' => $user_username ]);
    }

    /**
    * Create one new billing
    * @return Illuminate\Http\Response
    */
    public function store(Request $request)
    {
       $billing_name = $this->loginService->obtainLogin($request->user_id);
       //dd($billing_name);
       //dd($billing->where('user_id','=', $request->id)->first());

       $check = $this->successResponse($this->billingService->
                          createBilling($request->all(),
                          Response::HTTP_CREATED
                          ));
      if ($check->status() == 200)
      {
           $session = $request->session();
           $user_username = $session->get('user_username');
           // redirects if valid to billing page
           return redirect()->route('catalogues', ['catalogue' => $user_username ]);
       }
    }

    /**
    * Update an existed billing with POST method
    * @return Illuminate\Http\Response
    */
    public function storeupdate(Request $request, $billing)
    {
       $session = $request->session();
       $billing = $session->get('user_id');

       $check = $this->successResponse($this->billingService->
                          updateBilling($request->all(),$billing));

      if ($check->status() == 200)
      {
           // redirects if valid to billing page
           return redirect()->route('billings_exist',['billings_exist' => $billing]);
           //return redirect()->route('catalogues', ['catalogue' => 1]);
       }
    }

    /**
    * Obtains and show one billing
    * @return Illuminate\Http\Response
    */
    public function show(Request $request, $billing)
    {
       $billing_name = $this->loginService->obtainLogin($request->all);

       // Gets username object
       $jsonObject = json_decode($billing_name, true);

       // Takes the first username as a string NOT OBJECT
       $username1 = $jsonObject['data'][0]['username'];

       // Sends data, can't pass to billing microservice without error from localhost:8001
       return $this->successResponse($this->billingService->obtainBilling($jsonObject,
                              $billing));
    }

    /**
    * Update an existing billing
    * @return Illuminate\Http\Response
    */
    public function update(Request $request, $billing)
    {
       return $this->successResponse($this->billingService->editBilling(
                                $request->all(), $billing));
    }

    /**
    * Remove an existing billing
    * @return Illuminate\Http\Response
    */
    public function destroy($billing)
    {
       return $this->successResponse($this->billingService->deleteBilling($billing));
    }
}
