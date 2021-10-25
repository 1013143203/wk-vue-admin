<?php
namespace App\Services\Admin;

use App\Exceptions\AdminException;
use App\Models\Admin\Crontab;
class CrontabService extends BaseService
{
    public function __construct(Crontab $crontab)
    {
        $this->model = $crontab;
    }
    public function lists()
    {
        return $this->model->getAll();
    }
    public function create(array $input)
    {
        $this->model->createItem($input);
    }
    public function update(array $input){
        $this->model->updateItem($input);
    }
}
