<?php

namespace App\Services\Admin;

use App\Exceptions\Exception;
use App\Exceptions\AdminException;
use App\Models\Common\Area;
use App\Models\Common\City;
use App\Models\Common\Province;
use App\Models\Common\Street;

class CityPickerService extends BaseService
{
    public function __construct(Province $province)
    {
        $this->model = $province;
    }
    public function lists(array $input)
    {
        $level = isset($input['level'])?$input['level']:1;
        switch ($level){
            case 1:
                $model=new Province();
                $level_name='省';
                $color='#1890ff';
                break;
            case 2:
                $model=new City();
                $level_name='市';
                $color='#34e2e2';
                break;
            case 3:
                $model=new Area();
                $level_name='区';
                $color='#8ae234';
                break;
            case 4:
                $model=new Street();
                $level_name='镇/街';
                $color='#F4606C';
                break;
            default:
                $model=new Province();
                $level_name='省';
                $color='#1890ff';
        }
        $res = $model->whereQ(function ($query) use ($input){
            if(isset($input['pid'])){
                $query -> where('pid', $input['pid']);
            }
            if(isset($input['name'])){
                $query -> where('name', 'like', '%'.$input['name'].'%');
            }
        })
        ->getAll(false);
        ++$level;
        foreach ($res as &$l){
            if ($level<=4) $l['hasChildren']=true;
            $l['level']=$level;
            $l['level_name']=$level_name;
            $l['color']=$color;
        }
        return $res;
    }
}
