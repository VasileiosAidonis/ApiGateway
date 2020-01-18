<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class CatalogueService
{
    use ConsumesExternalService;

    /**
    * The base uri to consume the logins service
    * @var string
    */
    public $baseUri;

    public function __construct()
    {
       $this->baseUri = config('services.catalogues.base_uri');
    }

    /**
    * Obtain the view from the catalogue service
    * @return string
    */
    public function viewsCatalogue($catalogue)
    {
        return $this->performRequest('GET',"/catalogues1/{$catalogue}");
    }

    /**
    * Obtain the full list of catalogues from the catalogue service
    * @return string
    */
    public function obtainCatalogues()
    {
        return $this->performRequest('GET','/cataloguess');
    }

    /**
    * Create one catalogue from the catalogue service
    * @return string
    */
    public function createCatalogue($data)
    {
        return $this->performRequest('POST','/catalogues', $data);
    }

    /**
    * Obtain one catalogue from the catalogue service
    * @return string
    */
    public function obtainCatalogue($catalogue)
    {
        return $this->performRequest('GET',"/catalogues/{$catalogue}");
    }

    /**
    * Update one instance of catalogue from the catalogue service
    * @return string
    */
    public function editCatalogue($data, $catalogue)
    {
        return $this->performRequest('PUT',"/catalogues/{$catalogue}",
                                 $data);
    }

    /**
    * Remove one catalogue from the catalogue service
    * @return string
    */
    public function deleteCatalogue($catalogue)
    {
        return $this->performRequest('DELETE',"/catalogues/{$catalogue}");
    }
}
