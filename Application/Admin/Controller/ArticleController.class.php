<?php
namespace Admin\Controller;

class ArticleController extends CommonController
{
    /**
     * 文章列表
     */
    public function index()
    {
        $keyword = I('param.keyword','');

        $map = [
            'title' => ['like',"%$keyword%"]
        ];

        $article = D('Article');

        $page_size = 10;

        $count = $article->count();

        $pagination = new \Think\Page($count,$page_size);

        $data = $article->relation(['category','author'])->where($map)->limit($pagination->firstRow , $pagination->listRows)->select();

        $this->assign('article',$data);

        //分页跳转的时候保证查询条件
        foreach($map as $key=>$val) {
            $pagination->parameter[$key] = urlencode($val);
        }
        $this->assign('pagination',$pagination);

        $this->assign('keyword',$keyword);
        $this->assign('nav',[
            'title' => '文章列表'
        ]);
        $this->assign('breadcrumbs',[
            '文章列表' => '',
        ]);
        $this->display();
    }

    /**
     * 文章创建
     */
    public function create()
    {
        if(IS_POST && !IS_AJAX){
            $data['category_id'] = I('param.category_id');
            $data['title'] = I('param.title');
            $data['content'] = I('param.content');
            $data['description'] = I('param.description');
            $data['visible'] = I('param.visible',1);
            $data['due_at'] = strtotime(I('param.due_at'));
            $data['priority'] = I('param.priority');
            $data['browse'] = I('param.browse');
            $data['user_id'] = session('user')['id'];

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

    /**
     * 文章更新
     * @param $id
     */
    public function update($id)
    {
        if(IS_POST && !IS_AJAX){
            $data['category_id'] = I('param.category_id');
            $data['title'] = I('param.title');
            $data['content'] = I('param.content');
            $data['description'] = I('param.description');
            $data['visible'] = I('param.visible');
            $data['due_at'] = strtotime(I('param.due_at'));
            $data['priority'] = I('param.priority');
            $data['browse'] = I('param.browse');
            $data['user_id'] = session('user')['id'];

            $article = D('Article');

            if($article->where("id!=$id and title='{$data['title']}'")->count()){
                $this->error('文章标题已经存在');
            }

            $data = $article->create($data);

            if($data && $article->where(['id' => $id])->save($data)){
                $this->success('操作完成','/admin/article',1);
            }else{
                $this->error('操作失败'.$article->getError());
            }
        }else{
            $article = D('Article');

            if(!$current = $article->find($id)){
                $this->error('文章不存在');
            }

            $category = new CategoryController();

            $data = $category->deepSelect(0);

            $this->assign('category',$data);
            $this->assign('current',$current);

            $this->assign('nav',[
                'title' => '文章编辑'
            ]);
            $this->assign('breadcrumbs',[
                '文章列表' => U('/admin/article'),
                '文章编辑' => '',
            ]);
            $this->display('save');
        }
    }

    /**
     * 文章删除
     * @param $id
     */
    public function delete($id)
    {
        if(IS_AJAX){
            $this->ajaxReturn([
                'state' => 1,
                'message' => '删除成功',
            ]);
        }
    }
}