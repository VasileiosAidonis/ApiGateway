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
    public function index()
    {
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
