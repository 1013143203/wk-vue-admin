<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\SettingsService;
use App\Http\Requests\Admin\SettingsUpdateRequest;
use App\Http\Requests\Admin\SettingsCreateRequest;

class SettingsController extends Base
{
    public function __construct(SettingsService $configService)
    {
        parent::__construct();
        $this->service = $configService;
    }

    public function create(SettingsCreateRequest $request)
    {
        return success($this->service->create($request->input()));
    }

    public function edit($id)
    {
        $data = $this->service->edit($id);
        $data['value'] = json_decode($data['value'],true);
        return success($data);
    }

    public function update(SettingsUpdateRequest $request)
    {
        return success($this->service->update($request->only(['id','value','name','description'])));
    }
}
