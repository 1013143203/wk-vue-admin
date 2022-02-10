<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\RoleUpdateRequest;
use App\Http\Requests\Admin\RoleCreateRequest;
use App\Services\Admin\RoleService;

class RoleController extends Base
{
    public function __construct(RoleService $roleService)
    {
        parent::__construct();

        $this->service = $roleService;
    }

    public function create(RoleCreateRequest $request)
    {
        return success($this->service->create($request->input()));
    }

    public function edit($id)
    {
        return success($this->service->edit($id));
    }
    public function permission($id)
    {
        return success($this->service->permission($id));
    }
    public function savePermission(RoleUpdateRequest $request)
    {
        return success($this->service->savePermission($request->only(['id','permission'])));
    }

    public function update(RoleUpdateRequest $request)
    {
        return success($this->service->update($request->input()));
    }
}
