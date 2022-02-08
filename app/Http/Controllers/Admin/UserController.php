<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\UserService;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
class UserController extends Base
{
    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->service = $userService;
    }

    public function edit($id)
    {
        return success($this->service->edit($id));
    }

    public function create(UserCreateRequest $request){
        return success($this->service->create($request->input()));
    }
    public function update(UserUpdateRequest $request)
    {
        return success($this->service->update($request->input()));
    }
}
