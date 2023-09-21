<?php

namespace Modules\User\Services;

use Modules\User\Contracts\Authentication;
use Modules\User\Entities\Role;

class CustomerService
{
    private $auth;

    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function register($request)
    {
        return tap($this->auth->registerAndActivate($this->getCustomerData($request)), function ($user) {
            $role = Role::find(setting('customer_role'));
            $user->roles()->attach($role);
        });
    }

    private function getCustomerData($request)
    {
        return array_merge($request->billing, [
            'email' => $request->customer_email,
            'username' => $request->billing['first_name'].$request->billing['last_name'].rand(100,9999),
            'password' => $request->password,
        ]);
    }
}
