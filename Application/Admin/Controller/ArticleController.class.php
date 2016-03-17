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
            $data['category_id'] = I('param.category_id');
            $data['title'] = I('param.title');
            $data['content'] = I('param.content');
            $data['description'] = I('param.description');
            $data['visible'] = I('param.visible');
            $data['due_at'] = I('param.due_at');
            $data['priority'] = I('param.priority');
            $data['browse'] = I('param.browse');

            $article = D('Article');

            $data = $article->create($data);

            if($data && $article->add($data)){
                $this->success('操作完成','/admin/article',1);
            }else{
                $this->error('操作失败'.$article->getError());
            }
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