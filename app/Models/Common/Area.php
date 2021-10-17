<?php

namespace App\Models\Common;

use App\Traits\MysqlTable;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use MysqlTable;
    protected $table         = 'area';

    protected $primaryKey    = 'id';

    protected $fillable      = ['id','pid','name','short_name','lng','lat','edit'];
    public $timestamps = false;
    public function street_all()
    {
        return $this->hasMany(\App\Models\Common\Address\Street::class,'pid','id');
    }
}
