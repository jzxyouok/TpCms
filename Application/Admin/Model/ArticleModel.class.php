<?php
namespace Admin\Model;
use Think\Model;
class ArticleModel extends Model {

    // 自动验证
    protected $_validate = [
        ['title','require','文章标题必填'],
        ['title','','文章标题已经存在',0,'unique',3],
        ['content','require','文章内容必填'],
        ['content','200,30000','文章内容必须200-30000字内',0,'length'],
        ['description','require','文章描述必填'],
        ['priority','/^[0-9]+$/','优先级必须整数',0,'regex'],
        ['browse','/^[0-9]+$/','浏览量必须整数',0,'regex'],
    ];

    // 自动完成
    protected $_auto = [
        ['created_at','time',1,'function'],
        ['updated_at','time',2,'function'],
    ];

    // 插入数据前的回调方法
    protected function _before_insert(&$data, $options)
    {

    }
    // 插入成功后的回调方法
    protected function _after_insert($data, $options)
    {

    }
}
