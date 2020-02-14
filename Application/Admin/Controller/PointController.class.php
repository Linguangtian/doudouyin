<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
use Common\Model\LevelModel;

class PointController extends AdminBaseController{
    /**
     * 列表
     */
    public function index() {
        $list = M('point_level')->order('point asc')->select();
        $this->assign('list', $list);



        $this->display();
    }

    /**
     * 添加、编辑操作
     */
    public function add() {
        $model = M('point_level');
        if( IS_POST ) {
            $data = I('post.');
            $data['update_time'] = time();
            if ( $model->add ($data) ) {
                $this->success ('新增成功!');
            } else {
                $this->error ('新增失败!');
            }
        }
    }

    /**
     * 添加、编辑操作
     */
    public function edit() {
        $model = M('point_level');
        if( IS_POST ) {
            $data = I('post.');
            $data['update_time'] = time();
            if ($model->save ($data) !== false) {
                $this->success ('编辑成功!');
            } else {
                $this->error ('编辑失败!');
            }
        }
    }

    /**
     * xiao5    2019年7月8日15:59:39   信用分设置
     */
    public function set()
    {
        $model = M('point_set');

        if (IS_POST) {
            $data = I('post.');
            if ($model->where(['id' => 1])->save ($data) !== false) {
                $this->success ('设置成功!');
            } else {
                $this->error ('设置失败!');
            }

        } else {
            $info = $model->find();
            $this->assign('info', $info);
            $this->display();
        }
    }
}
