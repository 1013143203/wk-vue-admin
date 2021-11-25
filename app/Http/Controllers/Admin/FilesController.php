<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\FilesService;
use App\Http\Requests\Admin\FilesRequest;

class FilesController extends Base
{
    public function __construct(FilesService $filesService)
    {
        parent::__construct();

        $this->service = $filesService;
    }

    public function chunk(FilesRequest $request)
    {
        return success($this->service->chunk($request));
    }


    public function merge(FilesRequest $request)
    {
        return success($this->service->merge($request));
    }
}
