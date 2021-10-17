<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\SettingsService;
use Illuminate\Http\Request;

class SettingsController extends Base
{
    public function __construct(SettingsService $configService)
    {
        parent::__construct();
        $this->service = $configService;
    }

    public function create(Request $request)
    {
        return success($this->service->create($request->input()));
    }

    public function update(Request $request)
    {
        return success($this->service->update($request->input()));
    }
}
