<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\LoginRequest;
use App\Services\Admin\AuthService;

class AuthController extends Base
{
    public function __construct(AuthService $authService)
    {
        parent::__construct();

        $this->service = $authService;
    }
    public function info(Request $request){
        $request->user->auths=$this->service->getAuths($request->user->id);
        return success([
            'userInfo'=>$request->user
        ]);
    }
    public function login(){

        return success([
            'token'=>$this->service->login()
        ]);

    }
    public function logout(){

        return $this->service->logout();

    }
    public function getRouters(Request $request){
        return success($this->service->getRouters($request->user->id));
    }
}
