<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\MemberLevelService;
use App\Http\Requests\Admin\MemberLevelCreateRequest;
use App\Http\Requests\Admin\MemberLevelUpdateRequest;

class MemberLevelController extends Base
{
    public function __construct(MemberLevelService $memberLevelService)
    {
        parent::__construct();

        $this->service = $memberLevelService;
    }
}
