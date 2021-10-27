<?php

namespace App\Services\Admin;

use App\Exceptions\Exception;
use App\Exceptions\AdminException;
use App\Models\Admin\Member;
use App\Models\Admin\MemberLevel;


class MemberService extends BaseService
{
    public function __construct(Member $member)
    {
        $this->model = $member;
    }
    public function lists(array $input)
    {
        $res = $this->model
            ->selectQ("*")
            ->whereQ(function($query) use ($input){
                // 按照名称进行搜索
                if (!empty($input['query'])){
                    $queryQ = '%' . trim($input['query']) . '%';
                    $query->where('nickname', 'LIKE', $queryQ)
                        ->orwhere(function($query) use($queryQ){
                            $query->where('realname', 'LIKE', $queryQ);
                        })->orwhere(function($query) use($queryQ){
                            $query->where('mobile', 'LIKE', $queryQ);
                        });
                }
                if (!empty($input['date'])){
                    $query->whereBetween('created_at', $input['date']);
                }
            })
            ->withQ(['level'=>function($query){
                $query->select('id','name');
            }])
            ->paginate(PAGE,LIMIT)
            ->getAll();
        foreach ($res['lst'] as &$r){
            $r['level_name'] = $r['level']['name'];
        }
        return $res;
    }
    public function edit($id)
    {
        $res['data'] = $this->model->getItemById($id);
        $res['level'] = MemberLevel::where('status',1)->get(['id as value','name as label'])->toArray();

        return $res;
    }
    public function update(array $input)
    {

        parent::update($input);
    }
    public function create(array $input)
    {

    }
}
