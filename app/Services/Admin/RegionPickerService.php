<?php

namespace App\Services\Admin;

use App\Exceptions\Exception;
use App\Exceptions\AdminException;
use App\Models\Common\Area;
use App\Models\Common\City;
use App\Models\Common\Province;
use App\Models\Common\Street;

class RegionPickerService extends BaseService
{
    public function lists($code,$type)
    {
        $arr = [
            [
                'name'=>'省',
                'color'=>'#1890ff',
                'model'=>new Province()
            ],
            [
                'name'=>'市',
                'color'=>'#34e2e2',
                'model'=>new City(),
                'code'=>'province_code'
            ],
            [
                'name'=>'区',
                'color'=>'#8ae234',
                'model'=>new Area(),
                'code'=>'city_code'
            ],
            [
                'name'=>'镇/街',
                'color'=>'#F4606C',
                'model'=>new Street(),
                'code'=>'area_code'
            ]
        ];
        $current = $arr[$type];
        $res = $current['model']->whereQ(function ($query) use ($code,$current){
            if($code && $current['code']){
                $query -> where($current['code'], $code);
            }
        })
        ->getAll(false);
        foreach ($res as &$l){
            if ($type<3) $l['hasChildren']=true;
            $l['type']=$type;
            $l['level_name']=$current['name'];
            $l['color']=$current['color'];
        }
        return $res;
    }
}
