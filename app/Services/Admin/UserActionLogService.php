<?php

namespace App\Services\Admin;

use App\Exceptions\Exception;
use App\Models\Admin\UserActionLog;

class UserActionLogService extends BaseService
{
    public function __construct(UserActionLog $user_action_log)
    {
        $this->model = $user_action_log;
    }
    public function lists(array $input)
    {
        $res = $this->model->whereQ(function($query) use ($input){
            if (!empty($input['date'])){
                $query->whereBetween('created_at', $input['date']);
            }
        })->withQ(['user' => function($query){
            $query->select(['username','id']);
        }])->paginate(PAGE,LIMIT)->getAll();
        foreach ($res['lst'] as &$v){
            $v['username']=$v['user']['username'];
        }
        return $res;
    }
}