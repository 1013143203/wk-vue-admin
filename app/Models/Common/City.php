<?php

namespace App\Models\Common;

use App\Traits\MysqlTable;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use MysqlTable;
    protected $table         = 'city';

    protected $primaryKey    = 'id';

    protected $fillable      = ['id','pid','name','short_name','pinyin','initial','lng','lat','edit'];

    public $timestamps = false;
}
