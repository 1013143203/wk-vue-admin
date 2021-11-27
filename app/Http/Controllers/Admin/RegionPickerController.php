<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\RegionPickerService;

class RegionPickerController extends Base
{
    public function __construct(RegionPickerService $regionPickerService)
    {
        parent::__construct();
        $this->service = $regionPickerService;
    }
    public function lists($code,$type)
    {
        return success($this->service->lists($code,$type));
    }
}
