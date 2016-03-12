<?php
namespace Admin\Controller;

class RoleController extends CommonController
{
    public function index()
    {
        $role = D('Role');

        $page_size = 10;

        $count = $role->count();

        $pagination = new \Think\Page($count,$page_size);

        $data = $role->limit($pagination->firstRow , $pagination->listRows)->select();

        $this->assign('role',$data);

        $this->assign('pagination',$pagination);

        $this->assign('nav',[
            'title' => '角色列表'
        ]);
        $this->assign('breadcrumbs',[
            '角色列表' => '',
        ]);

        $this->display();
    }

    public function create()
    {
        if(IS_POST && !IS_AJAX){
            $data['name'] = I('param.name');
            $data['description'] = I('param.description');

            $role = D('Role');

            $data = $role->create($data);

            if($data && $role->add($data)){
                $this->success('操作完成','/admin/role',1);
            }else{
                $this->error('操作失败'.$role->getError());
            }
        }else{
            $this->assign('nav',[
                'title' => '角色创建'
            ]);
            $this->assign('breadcrumbs',[
                '角色列表' => U('/admin/role'),
                '角色创建' => '',
            ]);
            $this->display('save');
        }

    }

    public function update($id)
    {
        if(IS_POST && !IS_AJAX){
            $data['name'] = I('param.name');
            $data['description'] = I('param.description');

            $role = D('Role');

            $data = $role->create($data);

            if($data && $role->where(['id' => $id])->count() && $role->where(['id' => $id])->save($data)){
                $this->success('操作完成','/admin/role',1);
            }else{
                $this->error('操作失败'.$role->getError());
            }
        }else{
            $role = D('Role')->find($id);
            if(!$role){
                $this->error('角色不存在');
            }

            $this->assign('role',$role);

            $this->assign('nav',[
                'title' => '角色修改'
            ]);
            $this->assign('breadcrumbs',[
                '角色列表' => U('/admin/role'),
                '角色修改' => '',
            ]);
            $this->display('save');
        }
    }

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