<?php

namespace App\Services\Admin;

use App\Exceptions\Exception;
use App\Exceptions\AdminException;
use DB;

class BaseService
{
    protected $model;


    public function edit($id)
    {
        return $this->model->getItemById($id);
    }

    /*
     * 更新数据
     *
     * @param  array  $params
     *
     * @return mixed
     */
    public function update(array $params)
    {
        return $this->model->updateItem($params);
    }

    public function status(array $params)
    {
        return $this->model->updateItem($params);
    }

    public function create(array $params)
    {
        return $this->model->createItem($params);
    }
    public function delete($id)
    {
        return $this->model->delItem($id);
    }
}
