<?php
namespace Admin\Controller;

class IndexController extends CommonController
{
    /**
     * 首页
     */
    public function index()
    {
        $this->assign('nav',[
            'title' => '系统首页'
        ]);

        $this->display();
    }
}