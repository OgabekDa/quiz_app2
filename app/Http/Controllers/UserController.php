<?php

namespace App\Http\Controllers;

use App\Service\Users;
use http\Env\Request;

class UserController extends Users
{
    public function registratsiya(Request $request)
    {
        return parent::registratsiya($request); // TODO: Change the autogenerated stub
    }
}
