<?php

namespace App\Models\Admin\Log;

use App\Models\Admin\Base;

class UserAction extends Base
{
    protected $table         = 'user_action_log';		                // 为模型指定表名
    protected $primaryKey    = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'ip', 'action', 'timing', 'method', 'url', 'params', 'user_agent',"user_name"
    ];
    /**
     * 记录行为日志
     * @author 喂喂喂
     */
    public static function record($title = '')
    {
        $route = request()->route();
        $user = request("user");
        $user_id = $user->id;
        if ($user_id) {
            $action = $route->getAction();
            $params = request()->all()??[];
            unset($params['user']);
             // 日志数据
             $data = [
                 'user_id' => $user_id,
                 'user_name' => $user->username,
                 'action' => $action['controller'],
                 'method' => request()->method(),
                 'url' => request()->url(true), // 获取完成URL
                 'params' => json_encode($params),
                 'title' => !empty($title) ? $title : '操作日志',
                 'ip' => get_client_ip(),
                 'timing' => round(microtime(true)-LARAVEL_START,3),
                 'user_agent' => request()->server('HTTP_USER_AGENT'),
             ];
             // 日志入库
             self::create($data);
        }
    }
}
