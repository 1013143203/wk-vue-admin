<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\UserActionLogService;
use Illuminate\Http\Request;

class ActionLogController extends Base
{
    public function __construct(UserActionLogService $userActionLogService)
    {
        parent::__construct();

        $this->service = $userActionLogService;
    }
    public function index()
    {
        return success($this->service->lists(request()->input()));
    }
}
