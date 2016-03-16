<?php
namespace Admin\Controller;

class ArticleController extends CommonController
{
    public function index()
    {
        $this->assign('nav',[
            'title' => '文章列表'
        ]);
        $this->assign('breadcrumbs',[
            '文章列表' => '',
        ]);
        $this->display();
    }

    public function create()
    {
        if(IS_POST && !IS_AJAX){

        }else{
            $category = new CategoryController();

            $data = $category->deepSelect(0);

            $this->assign('category',$data);
            $this->assign('nav',[
                'title' => '文章发布'
            ]);
            $this->assign('breadcrumbs',[
                '文章列表' => U('/admin/article'),
                '文章发布' => '',
            ]);
            $this->display('save');
        }
    }

    public function update()
    {
        echo __METHOD__;
    }

    public function delete()
    {
        echo __METHOD__;
    }
}