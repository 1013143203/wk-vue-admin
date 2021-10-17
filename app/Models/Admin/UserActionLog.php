<?php

namespace App\Models\Admin;

class UserActionLog extends Base
{
    protected $table         = 'user_action_log';		                // 为模型指定表名
    protected $primaryKey    = 'id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'ip', 'action', 'timing', 'method', 'url', 'params', 'user_agent'
    ];
    public function user(){
        return $this->hasOne(User::Class,'id','user_id');
    }
    /**
     * 记录行为日志
     * @author 喂喂喂
     */
    public static function record($user_id, $title = '')
    {
        $route=request()->route();
        if ($user_id) {
            $action = $route->getAction();
            $params = request()->all()??[];
            unset($params['user']);
             // 日志数据
             $data = [
                 'user_id' => $user_id,
                 'action' => $action['controller'],
                 'method' => request()->method(),
                 'url' => request()->url(true), // 获取完成URL
                 'params' => json_encode($params),
                 'title' => !empty($title) ? $title : '操作日志',
                 'ip' => wk_getClientIp(),
                 'timing' => round(microtime(true)-LARAVEL_START,3),
                 'user_agent' => request()->server('HTTP_USER_AGENT'),
             ];
             // 日志入库
             self::create($data);
        }
    }
}
