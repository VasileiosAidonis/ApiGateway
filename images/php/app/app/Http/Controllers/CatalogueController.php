<?php

namespace App\Http\Controllers;

use App\Catalogue;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\CatalogueService;

class CatalogueController extends Controller
{
    use ApiResponser;

    /**
    * The service to consume the catalogues microservice
    * @var CatalogueService
    */
    public $catalogueService;

    /**
    * Create a new controller instance.
    * @return void
    */
    public function __construct(CatalogueService $catalogueService)
    {
        $this->catalogueService = $catalogueService;
    }

    /**
    * FRONT END
    * Fetch the catalogue view
    * @return Illuminate\Http\Response
    */
    public function views(Request $request, $catalogue)
    {
        $session = $request->session();
        $auth = $session->get('auth');

        if($auth == 'yes'){

           return $this->catalogueService->viewsCatalogue($catalogue);
        } else {

           return redirect()->route('logins');
        }
    }

    /**
    * BACK END
    * Return the list of catalogues
    * @return Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $session = $request->session();
        $user = $session->get('user_id');

        return redirect()->route('billings_exist',[
                   'billings_exist' => $user,
        ]);

        return $this->successResponse($this->catalogueService->obtainCatalogues());
    }

    /**
    * Create one new catalogue
    * @return Illuminate\Http\Response
    */
    public function store(Request $request)
    {
       return $this->successResponse($this->catalogueService->
                          createCatalogue($request->all(),
                          Response::HTTP_CREATED
                          ));
    }

    /**
    * Obtains and show one catalogue
    * @return Illuminate\Http\Response
    */
    public function show($catalogue)
    {
       return $this->successResponse($this->catalogueService->obtainCatalogue($catalogue));
    }

    /**
    * Redirect catalogue with new thumbnails
    * @return Illuminate\Http\Response
    */
    public function update_thumb(Request $request, $catalogue, $thumb)
    {
        $session = $request->session();
        $user_username = $session->get('user_username');
        $user = $session->get('user_id');

        $this->catalogueService->update_thumbCatalogue($request->all(), $user_username, $thumb);

        return redirect()->route('catalogues', [
                    'catalogue' => $user_username,
        ]);
    }

    /**
    * Update an existing catalogue
    * @return Illuminate\Http\Response
    */
    public function update(Request $request, $catalogue)
    {
       return $this->successResponse($this->catalogueService->editCatalogue(
                                $request->all(), $catalogue));
    }

    /**
    * Remove an existing catalogue
    * @return Illuminate\Http\Response
    */
    public function destroy($catalogue)
    {
       return $this->successResponse($this->catalogueService->deleteCatalogue($catalogue));
    }
}
