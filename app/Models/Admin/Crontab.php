<?php

namespace App\Models\Admin;

class Crontab extends Base
{
    protected $table         = 'crontab';		                // 为模型指定表名
    protected $primaryKey    = 'id';

    protected $fillable = [
        'name', 'sType', 'sBody', 'tType', 'week', 'day' , 'hour' ,'minute','create_id'
    ];

}
