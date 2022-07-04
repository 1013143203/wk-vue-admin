<?php

namespace App\Http\Controllers\Admin\Log;

use App\Services\Admin\Log\UserActionService;
use App\Http\Controllers\Admin\Base;

class UserActionController extends Base
{
    public function __construct(UserActionService $userActionLogService)
    {
        parent::__construct();

        $this->service = $userActionLogService;
    }
    public function index()
    {
        return success($this->service->lists(request()->input()));
    }
}
