<?php
namespace Admin\Controller;

class CategoryController extends CommonController
{
    public function index()
    {
        $category = D('Category');
        $page_size = 10;

        $count = $category->count();

        $pagination = new \Think\Page($count,$page_size);

        $data = $category->relation('parent')->limit($pagination->firstRow , $pagination->listRows)->select();

        $this->assign('category',$data);
        $this->assign('pagination',$pagination);
        $this->assign('nav',[
            'title' => '分类列表'
        ]);
        $this->assign('breadcrumbs',[
            '分类列表' => '',
        ]);
        $this->display();
    }

    public function create()
    {
        if(IS_POST && !IS_AJAX){
            $data = [
                'parent_id' => I('post.parent_id'),
                'name' => I('post.name'),
            ];

            $category = D('Category');

            $data = $category->create($data);

            if($data && $category->add($data)){
                $this->success('操作完成','/admin/category',1);
            }else{
                $this->error('操作失败'.$category->getError());
            }
        }else{
            $category = $this ->deepSelect(0);
            $this->assign('category',$category);
            $this->assign('nav',[
                'title' => '创建分类'
            ]);
            $this->assign('breadcrumbs',[
                '分类列表' => '/admin/category',
                '创建分类' => '',
            ]);
            $this->display('save');
        }
    }

    public function deepSelect($parent_id , &$data = [])
    {
        $category = D('Category');

        $current = $category->where(['parent_id' => $parent_id])->select();
        foreach($current as $key => $item){
            $data[] = $item;
            if($children = $category->where(['parent_id' => $item['id']])->count()){
                $this ->deepSelect($item['id'] , $data);
            }
        }

        return $data;
    }

    public function update($id)
    {
        if(IS_POST && !IS_AJAX){
            $data = [
                'parent_id' => I('post.parent_id'),
                'name' => I('post.name'),
            ];

            $category = D('Category');

            if($category->where("id!=$id and name='{$data['name']}'")->count()){
                $this->error('该分类已经存在');
            }

            $data = $category->create($data);

            if($data && $category->where(['id' => $id])->save($data)){
                $this->success('操作完成','/admin/category',1);
            }else{
                $this->error('操作失败'.$category->getError());
            }
        }else{
            $category = $this ->deepSelect(0);

            $current = D('Category')->find($id);
            if(!$current){
                $this->error('分类不存在');
            }

            $data = [];

            foreach($category as $item){
                if($item['id'] == $current['id'] || $item['level'] > $current['level']) continue;

                $data[] = $item;
            }

            $this->assign('category',$data);
            $this->assign('current',$current);
            $this->assign('nav',[
                'title' => '编辑分类'
            ]);
            $this->assign('breadcrumbs',[
                '分类列表' => '/admin/category',
                '编辑分类' => '',
            ]);
            $this->display('save');
        }
    }

    public function delete()
    {
        if(IS_AJAX){
            $this->ajaxReturn([
                'state' => 1,
                'message' => '删除成功',
            ]);
        }
    }
}