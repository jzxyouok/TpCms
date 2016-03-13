<?php
namespace Admin\Model;
use Think\Model;
class ExampleModel extends Model {

    // 自动验证
    protected $_validate = [];

    // 自动完成
    protected $_auto = [];

    // 插入数据前的回调方法
    protected function _before_insert(&$data, $options)
    {

    }
    // 插入成功后的回调方法
    protected function _after_insert($data, $options)
    {

    }
}
