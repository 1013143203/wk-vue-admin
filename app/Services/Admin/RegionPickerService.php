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
    public function loadProvince($input)
    {
        $province = $this->lists(0,0);
        $province_ids = array_column($province, 'id');

        if ($pid = $input['pid']){
            $pindex = array_search($pid,$province_ids);
            $currentProvince = $province[$pindex];
        }
        if ($cid = $input['cid']){
            $city = $this->lists($currentProvince['code'],1);
            $city_ids = array_column($city, 'id');
            $province[$pindex]['children'] = $city;
            $cindex = array_search($cid,$city_ids);
            $currentCity = $city[$cindex];
        }
        if ($aid = $input['aid']){
            $area = $this->lists($currentCity['code'],2);
            $area_ids = array_column($area, 'id');
            $province[$pindex]['children'][$cindex]['children'] = $area;
            $aindex = array_search($aid,$area_ids);
            $currentArea = $area[$aindex];
        }
        if ($sid = $input['sid']){
            $street = $this->lists($currentArea['code'],3);
            $province[$pindex]['children'][$cindex]['children'][$aindex]['children'] = $street;
        }

        return $province;
    }
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
            if ($type<3) {
                $l['hasChildren']=true;
            }else{
                $l['leaf']=true;
            }
            $l['type']=$type;
            $l['level_name']=$current['name'];
            $l['color']=$current['color'];
        }
        return $res;
    }
}
