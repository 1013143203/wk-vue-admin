<?php

namespace App\Models\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Traits\MysqlTable;
use App\Models\Admin\Role;

class User extends Authenticatable implements JWTSubject
{
    use MysqlTable;
    use Notifiable;
    
    protected $table         = 'user';		                // 为模型指定表名
    protected $primaryKey    = 'id';
    
    public function role(){
        return $this->belongsToMany(Role::class, 'user_role','user_id','role_id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'status',
    ];

    /**
     * 获取会储存到 jwt 声明中的标识
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * 返回包含要添加到 jwt 声明中的自定义键值对数组
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return ['role' => 'admin'];
    }
}
