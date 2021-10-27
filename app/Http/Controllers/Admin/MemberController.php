<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\MemberService;
use App\Http\Requests\Admin\MemberUpdateRequest;

class MemberController extends Base
{
    public function __construct(MemberService $memberService)
    {
        parent::__construct();

        $this->service = $memberService;
    }

    public function edit($id)
    {
        return success($this->service->edit($id));
    }

    public function update(MemberUpdateRequest $request)
    {
        return success($this->service->update($request->input()));
    }
}
