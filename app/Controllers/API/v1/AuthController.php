<?php

namespace App\Controllers\API\V1;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Shield\Models\UserModel;
use Config\Services;

class AuthController extends ResourceController
{
    protected $userModel;
    protected $validate;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->validate = Services::validation();
    }

    public function signIn()
    {
    }

    public function signUp()
    {
    }

    public function signOut()
    {
    }

    public function getUserData()
    {
    }
}
