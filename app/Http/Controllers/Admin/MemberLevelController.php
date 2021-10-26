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

    public function create(MemberLevelCreateRequest $request)
    {
        return success($this->service->create($request->input()));
    }

    public function edit($id)
    {
        return success($this->service->edit($id));
    }

    public function update(MemberLevelUpdateRequest $request)
    {
        return success($this->service->update($request->input()));
    }

    public function delete($id)
    {
        return success($this->service->delete($id),'操作成功');
    }
}
