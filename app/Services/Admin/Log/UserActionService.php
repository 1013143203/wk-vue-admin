<?php

namespace App\Services\Admin\Log;

use App\Exceptions\Exception;
use App\Models\Admin\Log\UserAction;
use App\Services\Admin\BaseService;

class UserActionService extends BaseService
{
    public function __construct(UserAction $user_action_log)
    {
        $this->model = $user_action_log;
    }
    public function lists(array $input)
    {
        $res = $this->model->whereQ(function($query) use ($input){
            if (!empty($input['date'])){
                $query->whereBetween('created_at', $input['date']);
            }
        })->paginate(PAGE,LIMIT)->getAll();
        foreach ($res['lst'] as &$v){
            $v['username']=$v['user']['username'];
        }
        return $res;
    }
}
