<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\FileService;
use App\Http\Requests\Admin\FileRequest;

class FileController extends Base
{
    public function __construct(FileService $fileService)
    {
        parent::__construct();

        $this->service = $fileService;
    }

    public function chunk(FileRequest $request)
    {
        return success($this->service->chunk($request));
    }


    public function merge(FileRequest $request)
    {
        return success($this->service->merge($request));
    }
}
