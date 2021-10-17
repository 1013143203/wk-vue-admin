<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\CityPickerService;

class CityPickerController extends Base
{
    public function __construct(CityPickerService $cityPickerService)
    {
        parent::__construct();
        $this->service = $cityPickerService;
    }
}
