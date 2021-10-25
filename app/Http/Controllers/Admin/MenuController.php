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
        if (in_array(request('type'),[1,2])){
            $data = $request->input();
        }else{
            $data = $request->only(['id','permission','pid','type','name']);
        }
        return success($this->service->create($data));
    }
    public function edit($id)
    {
        return success($this->service->edit($id));
    }
    public function update(MenuUpdateRequest $request)
    {
        if (in_array(request('type'),[1,2])){
            $data = $request->input();
        }else{
            $data = $request->only(['id','permission','pid','type','name']);
        }
        return success($this->service->update($data));
    }
}
