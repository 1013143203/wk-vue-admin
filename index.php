<?php
require 'vendor/autoload.php';
use QL\QueryList;

$urls=[
    [
        'title'=>'知乎',
        'url'=>'https://tophub.today/n/mproPpoq6O'
    ],
    [
    'title'=>'微博-热搜榜',
        'url'=>'https://tophub.today/n/KqndgxeLl9'
    ],
    [
        'title'=>'微博-话题榜',
        'url'=>'https://tophub.today/n/VaobJ98oAj'
    ],
    [
        'title'=>'微信-24h热文榜',
        'url'=>'https://tophub.today/n/WnBe01o371'
    ],
    [
        'title'=>'百度-实时热点',
        'url'=>'https://tophub.today/n/Jb0vmloB1G'
    ],
    [
        'title'=>'抖音-视频榜',
        'url'=>'https://tophub.today/n/DpQvNABoNE'
    ],
    [
        'title'=>'抖音-热搜榜',
        'url'=>'https://tophub.today/n/K7GdaMgdQy'
    ],
    [
        'title'=>'今日头条-头条热榜',
        'url'=>'https://tophub.today/n/x9ozB4KoXb'
    ],
    [
        'title'=>'今日头条-热文周榜',
        'url'=>'https://tophub.today/n/20MdKa2ow1'
    ],
    [
        'title'=>'哔哩哔哩-全站日榜',
        'url'=>'https://tophub.today/n/74KvxwokxM'
    ],
    [
        'title'=>'网易全站-24小时点击榜',
        'url'=>'https://tophub.today/n/G2me35rvwj'
    ],
    [
        'title'=>'搜狗-实时热点',
        'url'=>'https://tophub.today/n/NaEdZndrOM'
    ],
    [
        'title'=>'360搜索-实时热点榜单',
        'url'=>'https://tophub.today/n/KMZd7x6erO'
    ],
];

foreach ($urls as &$v){
    $ql=QueryList::get($v['url']);
    $v['data'] = json_decode(json_encode($ql->find('table:eq(1) .al a')->texts()),true);
    foreach ($v['data'] as $k=> $d){
        $v['time'][] = $ql->find("table:eq(1) tr:eq({$k}) td:eq(0)")->text();
    }
}



var_dump($urls);die;