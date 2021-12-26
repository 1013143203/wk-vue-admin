<?php
return [
    /**
     * 菜单类型
     */
    'menus_types' => [
        ['id'=>1,'name'=>'模块'],
        ['id'=>2,'name'=>'菜单'],
        ['id'=>3,'name'=>'节点'],
    ],
    /**
     * 菜单节点
     */
    'menus_nodes' => [
        ['id'=>2,'name'=>'添加','data'=>'create'],
        ['id'=>3,'name'=>'详情','data'=>'edit'],
        ['id'=>4,'name'=>'保存','data'=>'update'],
        ['id'=>5,'name'=>'状态','data'=>'status'],
        ['id'=>6,'name'=>'删除','data'=>'delete'],
        ['id'=>7,'name'=>'批量删除','data'=>'delAll'],
        ['id'=>8,'name'=>'全部展开','data'=>'expandAll'],
        ['id'=>9,'name'=>'全部折叠','data'=>'foldAll'],
    ],
];