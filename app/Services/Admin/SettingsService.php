<?php

namespace App\Services\Admin;

use App\Exceptions\Exception;
use App\Exceptions\AdminException;
use App\Models\Admin\Settings;

class SettingsService extends BaseService
{
    public function __construct(Settings $config)
    {
        $this->model = $config;
    }
    public function lists()
    {
        return $this->model->getAll(false);
    }
    public function create(array $input)
    {
        $this->model->createData($input);
    }
    public function update(array $input){
        $this->model->updateData($input);
    }
}
