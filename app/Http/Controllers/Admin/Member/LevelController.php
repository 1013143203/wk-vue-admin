<?php

namespace App\Http\Controllers\Admin\Member;

use App\Services\Admin\Member\LevelService;
use App\Http\Requests\Admin\Member\LevelCreateRequest;
use App\Http\Requests\Admin\Member\LevelUpdateRequest;
use App\Http\Controllers\Admin\Base;

class LevelController extends Base
{
    public function __construct(LevelService $memberLevelService)
    {
        parent::__construct();

        $this->service = $memberLevelService;
    }

    public function create(LevelCreateRequest $request)
    {
        return success($this->service->create($request->input()));
    }

    public function edit($id)
    {
        return success($this->service->edit($id));
    }

    public function update(LevelUpdateRequest $request)
    {
        return success($this->service->update($request->input()));
    }

    public function delete($id)
    {
        return success($this->service->delete($id),'操作成功');
    }
}
