<?php

namespace App\Services\Admin;

use App\Exceptions\Exception;
use App\Exceptions\AdminException;
use App\Models\Admin\Member;
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

    public function create(array $input)
    {
        $this->model->createItem($input);
    }

    public function delete($id)
    {
        $member = new Member();
        if (!$member->whereQ(['level'=>$id])->getItem()){
            return $this->model->delItem($id);
        }else{
            throw new AdminException(201,'会员存在此等级');
        }
    }
}
