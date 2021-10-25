<?php

namespace App\Services\Admin;

use App\Exceptions\Exception;
use App\Exceptions\AdminException;
use App\Models\Admin\MemberLevel;


class MemberLevelService extends BaseService
{
    public function __construct(MemberLevel $member_level)
    {
        $this->model = $member_level;
    }
    public function lists(array $input)
    {
        $res = $this->model
            ->selectQ("*")
            ->whereQ(function($query) use ($input){
                // 按照名称进行搜索
                if (!empty($input['query'])){
                    $name = '%' . trim($input['name']) . '%';
                    $query->where('name', 'LIKE', $name);
                }
                if (!empty($input['date'])){
                    $query->whereBetween('created_at', $input['date']);
                }
            })
            ->paginate(PAGE,LIMIT)
            ->getAll();

        return $res;
    }
    public function edit($id)
    {

        return $res;
    }
    public function update(array $input)
    {

        parent::update($input);
    }
    public function create(array $input)
    {

    }
}
