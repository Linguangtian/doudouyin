<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
use Common\Model\LevelModel;

class TaskController extends AdminBaseController{

    /**
     * 列表
     */
    public function index() {

        //会员等级
        $level_list = LevelModel::get_member_level();
        // unset($level_list[3]);//不分钻石会员
        $this->assign ( 'level_list', $level_list );

        $map = $this->_search();
        $type = I('get.type');
        $level = I('get.level');
        if( $type!='' ) $map['type'] = $type;
        if( $level!='' ) $map['level'] = $level;

        //列表数据
        $list = $this->_list ('task', $map );
        $task_type = C('TASK_TYPE');
        foreach( $list as &$_list ) {
            $_list['level_name'] = $level_list[$_list['level']]['name'];
            $_list['type_name'] = $task_type[$_list['type']];
        }
        $this->assign('list',$list);
        $this->assign('get',$_GET);



        $this->display();
    }

    /**
     * 添加、编辑操作
     */
    public function handle() {
        $model = M ('task');
        if( IS_POST ) {
            $data = I('post.');
            foreach($data as $key=>$val){
                if(is_array($val)){
                    $data[$key] = implode(',', $val);
                }
            }

            $id = $data[$model->getPk ()];
            if( isset($data['content']) ) $data['content'] = I('content','',false);
            $data['end_time'] = strtotime($data['end_time']." 23:59:59");
            if( !($id > 0) ) {
                $time = time();
                $data['create_time'] = $time;
                $data['update_time'] = $time;
                if ( $model->add ($data) ) {
                    $this->success ('新增成功!', U('index'));
                } else {
                    $this->error ('新增失败!');
                }
            } else {
                if( !is_numeric($data['update_time']) ) {
                    $data['update_time'] = strtotime($data['update_time']);
                } else {
                    $data['update_time'] = time();
                }

                $copy = intval(I('post.copy'));
                if( $copy == 1 ) {
                    $time = time();
                    $data['create_time'] = $time;
                    $data['update_time'] = $time;
                    unset($data['id']);
                    if ( $model->add ($data) ) {
                        $this->success ('复制成功!', U('index'));
                    } else {
                        $this->error ('复制失败!');
                    }
                } else {
                    if ($model->save ($data) !== false) {

                        M('task_apply')->where(['task_id' => $id, 'is_end' => 0])->save(['end_time' => $data['end_time']]);

                        $this->success ('编辑成功!', U('index'));
                    } else {
                        $this->error ('编辑失败!');
                    }
                }
            }
        } else {
            $data = I('get.');
            $id = intval($data[$model->getPk()]);
            if( $id > 0) {
                $info = $model->find ( $id );
                $this->assign ( 'info', $info );
            }
            //会员等级
            $level = LevelModel::get_member_level();
//            unset($level[3]);//不分钻石会员
            $this->assign ( 'level', $level );
            $this->display ();
        }
    }


    /**
     * 删除
     */
    public function delete() {
        $model = M ('task');

        $ids = I('ids', '');
        if (is_array($ids)) {
            $ids = implode(',', $ids);
            $map['id'] = ['in', $ids];
        } else {
            $data = I('get.');
            $pk = $model->getPk();
            $id = intval($data[$pk]);
            $map[$pk] = array ('eq', $id );
        }

        $result = $model->where($map)->delete();
        if( $result ) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    /**
     * xiao5    2019年7月10日17:35:03  批量删除
     */
    public function batchDel()
    {
        $ids = I('ids');
        var_dump($ids);
    }


    /**
     * 列表
     */
    public function cate_index() {

        //会员等级
        $level_list = LevelModel::get_member_level();
        // unset($level_list[3]);//不分钻石会员
        $this->assign ( 'level_list', $level_list );

        $map = $this->_search();
        $type = I('get.type');
        $level = I('get.level');
        if( $type!='' ) $map['type'] = $type;
        if( $level!='' ) $map['level'] = $level;

        //列表数据
        $list = $this->_list ('task', $map );
        $task_type = C('TASK_TYPE');
        foreach( $list as &$_list ) {
            $_list['level_name'] = $level_list[$_list['level']]['name'];
            $_list['type_name'] = $task_type[$_list['type']];
        }
        $this->assign('list',$list);
        $this->assign('get',$_GET);



        $this->display();
    }



}