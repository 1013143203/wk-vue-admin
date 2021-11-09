<?php
namespace App\Services\Admin;

use App\Exceptions\AdminException;
use App\Models\Admin\FileSystems;

class FileService extends BaseService
{
    public function __construct(FileSystems $file_systems)
    {
        $this->model = $file_systems;
    }
}
