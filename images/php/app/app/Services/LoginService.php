<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class LoginService
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
    * Obtain the view from the login service
    * @return string
    */
    public function viewsLogin()
    {
        return $this->performRequest('GET','/logins1');
    }

    /**
    * Obtain the full list of users from the login service
    * @return string
    */
    public function obtainLogins()
    {
        return $this->performRequest('GET','/logins');
    }

    /**
    * Create one user from the login service
    * @return string
    */
    public function createLogin($data)
    {
        return $this->performRequest('POST','/logins', $data);
    }

    /**
    * Obtain one user from the login service
    * @return string
    */
    public function obtainLogin($login)
    {
        return $this->performRequest('GET',"/logins/{$login}");
    }

    /**
    * Update one instance of user from the login service
    * @return string
    */
    public function editLogin($data, $login)
    {
        return $this->performRequest('PUT',"/logins/{$login}",
                                 $data);
    }

    /**
    * Remove one user from the login service
    * @return string
    */
    public function deleteLogin($login)
    {
        return $this->performRequest('DELETE',"/logins/{$login}");
    }
}
