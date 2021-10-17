<?php

namespace App\Models\Common;

use App\Traits\MysqlTable;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use MysqlTable;
    protected $table         = 'province';

    protected $primaryKey    = 'id';

    protected $fillable      = ['id','name','short_name','pinyin','initial','lng','lat','edit'];
    public $timestamps = false;
    public function city_all()
    {
        return $this->hasMany(\App\Models\Common\Address\City::class,'pid','id');
    }
}
