<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class CategoryModel extends RelationModel {

    protected $_link = [
        'parent'=>[
            'mapping_type'      => self::BELONGS_TO,
            'class_name'        => 'Category',
            'mapping_name'      => 'parent',
        ],
    ];

    // 自动验证
    protected $_validate = [
        ['name','require','分类名称必填'],
        ['name','','分类名称已经存在',0,'unique',2],
    ];

    // 自动完成
    protected $_auto = [
        ['created_at','time',2,'function'],
        ['updated_at','time',1,'function'],
    ];

    // 插入数据前的回调方法
    protected function _before_insert(&$data, $options)
    {
        $parent_id = $data['parent_id'];

        if($parent_id){
            $parent = $this->find($parent_id);
            $data['level'] = ++$parent['level'];
        }
    }
    // 插入成功后的回调方法
    protected function _after_insert($data, $options)
    {
        if(!$data['parent_id']){
            $data['node_index'] = ",".$data['id'].",";
        }else{
            $parent = $this->find($data['parent_id']);
            $data['node_index'] = ",".$data['id'].$parent['node_index'];
        }
        $this->save($data);
    }

    // 更新数据前的回调方法
    protected function _before_update(&$data, $options)
    {
        $parent_id = $data['parent_id'];

        if($parent_id){
            $parent = $this->find($parent_id);
            $data['level'] = ++$parent['level'];
        }else{
            $data['level'] = 1;
        }
    }
    // 更新成功后的回调方法
    protected function _after_update($data, $options)
    {
        if(!$data['parent_id']){
            $data['node_index'] = ",".$data['id'].",";
        }else{
            $parent = $this->find($data['parent_id']);
            $data['node_index'] = ",".$data['id'].$parent['node_index'];
        }

        $sql = "update {$this->getTableName()} set node_index='{$data['node_index']}' where id={$data['id']}";
        $this->execute($sql);
        if($children = $this->where(['parent_id' => $data['id']])->select()){
            foreach($children as $child){
                $column = [
                    'node_index' => ",".$child['id'].$data['node_index'],
                    'parent_id' => $data['id'],
                ];
                $this->where(['id' => $child['id']])->save($column);
            }
        }
    }
}
