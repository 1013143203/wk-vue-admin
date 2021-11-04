<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\FileService;

class FileController extends Base
{
    public function __construct(FileService $fileService)
    {
        parent::__construct();

        $this->service = $fileService;
    }

    public function chunk()
    {
        return success();
    }


    public function merge()
    {
        return success();
    }
}
