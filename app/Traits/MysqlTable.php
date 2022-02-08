<?php

declare(strict_types=1);

namespace App\Traits;

use App\Exceptions\AdminException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait MysqlTable
{
    private $whereQ = [];
    private $selectQ = ['*'];
    private $withQ = [];
    private $withCountQ = [];
    private $sortQ = ['id'=>'desc'];
    private $pageQ;
    private $limitQ;


    public function whereQ($where){
        $this->whereQ=$where;
        return $this;
    }

    public function selectQ($select){
        $this->selectQ=$select;
        return $this;
    }

    public function withQ($with){
        $this->withQ=$with;
        return $this;
    }

    public function withCountQ($withCount){
        $this->withCountQ=$withCount;
        return $this;
    }

    public function sortQ(array $sort){
        $this->sortQ=$sort;
        return $this;
    }

    public function whereHasQ($whereHas = []){
        if (!empty($whereHas)) foreach ($whereHas as $key => $val) {
            $this->whereHas($key, function ($query) use ($val) {
                $query->where($val);
            });
        }
        return $this;
    }

    public function whereHasInQ($whereHasIn = []){
        if (!empty($whereHasIn)) foreach ($whereHasIn as $key => $val) {
            $this->whereHas($key, function ($query) use ($val) {
                $query->whereIn($val);
            });
        }
        return $this;
    }

    public function whereInQ($whereIn = []){
        if (!empty($whereIn)) foreach ($whereIn as $val) {
            $this->whereIn($val[0], $val[1]);
        }
        return $this;
    }

    public function orwhereQ($orwhere = []){
        if (!empty($orwhere)) foreach ($orwhere as $val) {
            $this->orWhere($val);
        }
        return $this;
    }

    public function paginate($page ,$limit)
    {
        $this->pageQ=$page;
        $this->limitQ=$limit;
        return $this;
    }

    public function getAll($count = true)
    {

        $model = $this->where($this->whereQ)
            ->with($this->withQ)
            ->select($this->selectQ);

        if($count) {
            $total = $model->count();
        }
        if ($this->pageQ){
            $model->offset(($this->pageQ - 1) * $this->limitQ);
            $model->limit($this->limitQ);
        }

        $model->when($this->sortQ, function ($query, $sort) {
            foreach ($sort as $k => $v) {
                $query->orderBy($k, $v);
            }
        });

        $lst = $model->get()->toArray() ?? [];
        if ($count){
            return [
                'total'=>isset($total) ?$total: 0,
                'lst'=>$lst,
            ];
        }
        return $lst;
    }


    /*
     * 过滤移除非当前表的字段参数
     *
     * @param  array  $params
     *
     * @return array
     */
    public function setFilterFields(array $params): array
    {
        $fields = Schema::getColumnListing($this->getTable());
        foreach ($params as $key => $param) {
            if (!in_array($key, $fields)) unset($params[$key]);
        }
        // 同时过滤时间戳字段【时间戳只允许自动更改，不允许手动设置】
        if ($this->timestamps === true && isset($params[self::CREATED_AT])) unset($params[self::CREATED_AT]);
        if ($this->timestamps === true && isset($params[self::UPDATED_AT])) unset($params[self::UPDATED_AT]);
        return $params;
    }

    /*
     * 更新数据
     *
     * @param  array  $params
     *
     * @return mixed
     */
    public function updateItem(array $params)
    {
        $model = $this::query();

        DB::beginTransaction();
        try {
            $primaryKey = self::getKeyName();
            $id = $params[$primaryKey];
            unset($params[$primaryKey]);
            $model->find($id)->update(self::setFilterFields($params));
            DB::commit();
            return $id;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new AdminException(201,$e->getMessage());
        }

    }
    public function createItem(array $params){
        $model = $this::query();

        DB::beginTransaction();
        try {
            $primaryKey = self::getKeyName();
            unset($params[$primaryKey]);
            $res = $model->create(self::setFilterFields($params));
            DB::commit();
            return $res->id;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new AdminException(201,$e->getMessage());
        }
    }
    public function delItem($ids){
        $model = $this::query();
        if (!is_array($ids)) {
            $ids = [$ids];
        }
        $model->whereIn('id', $ids)->delete();
//        withTrashed() 显示所有数据
//            onlyTrashed() 显示删除数所
//            restore()还原数据
    }
}
