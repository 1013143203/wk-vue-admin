<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CrontabUpdateRequest;
use App\Services\Admin\CrontabService;
use App\Http\Requests\Admin\CrontabCreateRequest;

class CrontabController extends Base
{
    public function __construct(CrontabService $crontabService)
    {
        parent::__construct();

        $this->service = $crontabService;
    }

    public function create(CrontabCreateRequest $request)
    {
        return success($this->service->create($request->input()));
    }
    public function edit($id)
    {
        return success($this->service->edit($id));
    }


    public function update(CrontabUpdateRequest $request)
    {
        return success($this->service->update($request->input()));
    }
}
