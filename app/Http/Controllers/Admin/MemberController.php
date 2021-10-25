<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\MemberService;

class MemberController extends Base
{
    public function __construct(MemberService $memberService)
    {
        parent::__construct();

        $this->service = $memberService;
    }
}
