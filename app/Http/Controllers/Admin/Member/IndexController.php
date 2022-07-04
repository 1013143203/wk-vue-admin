<?php

namespace App\Http\Controllers\Admin\Member;

use App\Services\Admin\Member\IndexService;
use App\Http\Requests\Admin\Member\IndexUpdateRequest;
use App\Http\Controllers\Admin\Base;

class IndexController extends Base
{
    public function __construct(IndexService $memberService)
    {
        parent::__construct();

        $this->service = $memberService;
    }

    public function edit($id)
    {
        return success($this->service->edit($id));
    }

    public function update(IndexUpdateRequest $request)
    {
        return success($this->service->update($request->input()));
    }
}
