<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class RegisterService
{
    use ConsumesExternalService;

    /**
    * The base uri to consume the logins service
    * @var string
    */
    public $baseUri;

    public function __construct()
    {
       $this->baseUri = config('services.logins.base_uri');
    }

    /**
    * Obtain the view from the register service
    * @return string
    */
    public function viewsRegister()
    {
        return $this->performRequest('GET','/registers1');
    }    

    /**
    * Obtain the full list of users from the login service
    * @return string
    */
    public function obtainRegisters()
    {
        return $this->performRequest('GET','/registers');
    }

    /**
    * Create one user from the login service
    * @return string
    */
    public function createRegi($data)
    {
        return $this->performRequest('GET','/registers/create', $data);
    }

    /**
    * Create one user from the login service
    * @return string
    */
    public function createRegister($data)
    {
        return $this->performRequest('POST','/registers', $data);
    }

    /**
    * Obtain one user from the login service
    * @return string
    */
    public function obtainRegister($register)
    {
        return $this->performRequest('GET',"/registers/{$register}");
    }

    /**
    * Update one instance of user from the login service
    * @return string
    */
    public function editRegister($data, $register)
    {
        return $this->performRequest('PUT',"/registers/{$register}",
                                 $data);
    }

    /**
    * Remove one user from the login service
    * @return string
    */
    public function deleteRegister($register)
    {
        return $this->performRequest('DELETE',"/registers/{$register}");
    }
}
