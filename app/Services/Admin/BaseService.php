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
        return $this->model->find($id)->toArray();
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
        if (request("user")->id){
            $params["update_id"] = request("user")->id;
        }
        return $this->model->updateItem($params);
    }

    public function status(array $params)
    {
        if (request("user")->id){
            $params["update_id"] = request("user")->id;
        }
        return $this->model->updateItem($params);
    }

    public function create(array $params)
    {
        if (request("user")->id){
            $params["create_id"] = request("user")->id;
        }
        return $this->model->createItem($params);
    }
    public function delete($id)
    {
        return $this->model->delItem($id);
    }
}
