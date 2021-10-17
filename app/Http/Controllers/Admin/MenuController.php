<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\MenuCreateRequest;
use App\Http\Requests\Admin\MenuUpdateRequest;
use App\Services\Admin\MenuService;

class MenuController extends Base
{
    public function __construct(MenuService $menuService)
    {
        parent::__construct();
        $this->service = $menuService;
    }
    public function index()
    {
        return success($this->service->lists(request()->input()));
    }
    public function create(MenuCreateRequest $request)
    {
        return success($this->service->create($request->input()));
    }
    public function edit($id)
    {
        return success($this->service->edit($id));
    }
    public function update(MenuUpdateRequest $request)
    {
        return success($this->service->update($request->input()));
    }
}
