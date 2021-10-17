<?php

namespace App\Models\Common;

use App\Traits\MysqlTable;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use MysqlTable;
    protected $table         = 'street';

    protected $primaryKey    = 'id';

    protected $fillable      = ['pid','id','name','short_name','lng','lat','edit'];
    public $timestamps = false;

}
