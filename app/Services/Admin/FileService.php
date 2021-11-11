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
    public function chunk()
    {
        if ($_GET['identifier']){
            if ($this->model->where('md5',$_GET['identifier'])->first()){
                return ['skipUpload'=>true];
            }
            return ['skipUpload'=>true];
        }else{
            return ['skipUpload'=>true];
        }
    }
}
