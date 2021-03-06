<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;
use Config;

class BillingService
{
    use ConsumesExternalService;

    /**
    * The base uri to consume the logins service
    * @var string
    */
    public $baseUri;

    public function __construct()
    {
       $this->baseUri = config('services.billings.base_uri');
    }

    /**
    * Obtain the view from the billing service
    * @return string
    */
    public function viewsBilling()
    {
        return $this->performRequest('GET','/billings1');
    }

    /**
    * Obtain the billings_exist view from the billing service
    * @return string
    */
    public function viewsBilling_exist($billing)
    {
        return $this->performRequest('GET',"/billings1/{$billing}");
    }

    /**
    * Obtain the full list of billings from the billing service
    * @return string
    */
    public function obtainBillings()
    {
        return $this->performRequest('GET','/billings');
    }

    /**
    * Create one billing from the billing service
    * @return string
    */
    public function createBilling($data)
    {
        return $this->performRequest('POST','/billings', $data);
    }

    /**
    * Update one billing from the billing service
    * @return string
    */
    public function updateBilling($data, $billing)
    {
        return $this->performRequest('POST',"/billings/{$billing}", $data);
    }

    /**
    * Obtain one billing from the billing service
    * @return string
    */
    public function obtainBilling($jsonObject, $billing)
    {
        return $this->performRequest('GET',"/billings/{$billing}", $jsonObject);
    }

    /**
    * Update one instance of billing from the billing service
    * @return string
    */
    public function editBilling($data, $billing)
    {
        return $this->performRequest('PUT',"/billings/{$billing}",
                                 $data);
    }

    /**
    * Remove one billing from the billing service
    * @return string
    */
    public function deleteBilling($billing)
    {
        return $this->performRequest('DELETE',"/billings/{$billing}");
    }
}
