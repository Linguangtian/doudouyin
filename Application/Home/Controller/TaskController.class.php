<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
use Common\Model\LevelModel;
use Common\Model\MemberModel;

class TaskController extends HomeBaseController{
    public function index()
    {
        //完成任务动态
        $finish_task_apply_list = M('member_price_log')->alias('a')
            ->join(C('DB_PREFIX').'member as b on a.member_id = b.id','left')
            ->where(array('a.type'=>array('elt',3)))
            ->field('a.*,b.username')
            ->limit(20)->select();
        foreach($finish_task_apply_list as &$_list) {
            $username = sp_substr_cut($_list['username']);
            $price = floatval($_list['price']);
            if( $_list['type'] == 1 ) {
                $_list['text'] = "恭喜{$username}获得任务奖励{$price}元。";
            }elseif( $_list['type'] == 2 ) {
                $_list['text'] = "恭喜{$username}获得下级返佣奖励{$price}元。";
            }elseif( $_list['type'] == 3 ) {
                $_list['text'] = "恭喜{$username}获得{$price}元推荐奖励。";
            }
        }
      
        $list = M('page')->field('id,title,create_time')->order('sort asc,id asc')->limit(10)->select();
        $this->assign('list', $list);
      
      
        $this->assign('finish_task_apply_list',$finish_task_apply_list);
        $this->assign('title','任务中心');
        $this->display();
    }

    public function lists_sub()
    {
        if (isset($_REQUEST['start']) && !empty($_REQUEST['start'])) {
            $start = $_REQUEST['start'];

            $level_title = C('TASK_LEVEL');
            $level = I('get.level');

            $map['status'] = 1;
            $map['level'] = $level;

            //供应信息
            $task_list = M('task')->where($map)->order('id desc')->limit($start,10)->select();

            $level_list = LevelModel::get_member_level();
            $cate_list = M('Category')->field('*')->where(array('is_show'=>1))->order('order_number')->select();
            foreach( $task_list as &$_list ) {
                $_list['level_name'] = $level_list[$_list['level']]['name'];
                //$_list['type_name'] = $task_type[$_list['type']];
                $_list['end_time'] = date('Y-m-d', $_list['end_time']);;
                $_list['editUrl'] = U('Task/handle', array('id' => $_list['id']));;
                $_list['leftnum'] = $_list['max_num'] - $_list['apply_num'];

                foreach ($cate_list as $it) {
                    if ($_list['cid'] == $it['id']) {
                        $_list['name'] = $it['name'];
                        $_list['ico'] = $it['ico'];
                    }
                }
                $item['ico'] = empty($item['ico']) ? sp_cfg('logo') : $item['ico'];
            }


            header('Content-Type:application/json; charset=utf-8');
            echo json_encode((object)array('info'=>$task_list,'status'=>1));exit();
        }

        $level_title = C('TASK_LEVEL');
        $level = I('get.level');

        //供应信息
        $task_list = M('task')->where(array('status'=>1,'level'=>$level))->order('id desc')->limit(10)->select();
//        $task_list['type_0'] = M('task')->where(array('type'=>0,'status'=>1,'level'=>$level))->limit(5)->order('id desc')->select();
        //需求信息
        //$task_list['type_1'] = M('task')->where(array('type'=>1,'status'=>1,'level'=>$level))->order('id desc')->select();
//        $task_list['type_1'] = M('task')->where(array('type'=>1,'status'=>1,'level'=>$level))->limit(5)->order('id desc')->select();
        $level_list = LevelModel::get_member_level();
        $cate_list = M('Category')->field('*')->where(array('is_show'=>1))->order('order_number')->select();


        foreach( $task_list as &$_list ) {
            $_list['level_name'] = $level_list[$_list['level']]['name'];
            $_list['end_time'] = date('Y-m-d', $_list['end_time']);;
            $_list['editUrl'] = U('Task/handle', array('id' => $_list['id']));;

            foreach ($cate_list as $it) {
                if ($_list['cid'] == $it['id']) {
                    $_list['name'] = $it['name'];
                    $_list['ico'] = $it['ico'];
                }
            }
            $item['ico'] = empty($item['ico']) ? sp_cfg('logo') : $item['ico'];
        }

        $this->assign('task_list',$task_list);
        $this->assign('title', $level!='' ? $level_title[$level] : '任务大厅');
        $this->assign('level', $level);



        $this->display();
    }
  
    public function lists_lb()
    {
        
        $level = I('get.lb');

        //供应信息
        $task_list['type_0'] = M('task')->where(array('type'=>0,'status'=>1,'tasklb'=>$level))->limit(15)->order('id desc')->select();
        //需求信息
        $task_list['type_1'] = M('task')->where(array('type'=>1,'status'=>1,'tasklb'=>$level))->limit(15)->order('id desc')->select();
        $this->assign('task_list',$task_list);
      	$lb = $level == 1 ? '抖音' :'快手';
        $this->assign('title', $lb.'-任务大厅');

        $this->display();
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
  
  

    public function lists()
    {
        $map = array();
        $level = I('get.level');
        if( !empty($cid) ) {
            $map['level'] = $level;
        }
        $type = I('get.type');
        if( $type!='' ) $map['type'] = $type;
        $this->_list('task',$map);

        if( $type==0 ) {
            $title = "发布的供应信息";
        } elseif($type==1 ) {
            $title = "发布的需求信息";
        } else {
            $title = "任务大厅";
        }
        $this->assign('title',$title);
        $this->display();
    }

    public function show()
    {
        $id = intval(I('get.id'));
        $show = M('task')->find($id);

        if ($show['uid']) {
            $user = M('member')->find($show['uid']);
            if ($user) {
                $show['username'] = $user['nickname'].'('.$user['id'].')';
            }
        }else{
            $show['username'] = sp_cfg('website').'官方('.sp_cfg('website').')';
        }

        $this->assign('show', $show);

        //检测是否已领取
        $member_id = $this->get_member_id();
        $check_apply = M('task_apply')->where(array('task_id'=>$id,'member_id'=>$member_id))->find();


        if( $show['end_time'] > time() ) {
            if( empty($check_apply) ) {
                if( $show['apply_num'] < $show['max_num'] ) {
                    $btn_status = 1;
                    $status_text = "领取任务";
                    $is_ling = 0;
                } else {
                    $btn_status = 0;
                    $status_text = "任务名额已满";
                    $is_ling = 0;
                }
            } elseif ($check_apply['status'] == 2) {
                $btn_status = 0;
                $status_text = "已完成";
                $is_ling = 1;
            } else {
                $btn_status = 0;
                $status_text = "已领取，点击提交";
                $is_ling = 1;
            }
        } else {
            $btn_status = 0;
            $status_text = "任务已过期";
            $is_ling = 0;
        }

        if ($check_apply['status'] == 0) {
            $redirect_url = U('submission_task_do', ['id' => $check_apply['id']]);
        } else {
            $redirect_url = U('Member/apply_show', ['id' => $check_apply['id']]);
        }
        $this->assign('redirect_url', $redirect_url);
        $this->assign('is_ling', $is_ling);
        $this->assign('btn_status', $btn_status);
        $this->assign('status_text', $status_text);
        $this->assign('member_client_info', session('member_client_info'));
        $this->display();
    }

    /**
     * 待提交的任务
     */
    public function submission_task()
    {
        if( !$this->is_login() ) {
            $this->error("请先登录");
        }
        $member_id = $this->get_member_id();

        $map = array();
        $map['a.member_id'] = $member_id;
        $map['a.status'] = array('eq',0);
        $model = M('task_apply');
        $count = $model->alias('a')->where($map)->count();
        $page = sp_get_page_m($count, 10);//分页
        $firstRow = $page->firstRow;
        $listRows = $page->listRows;

        $map['title'] = ['neq', 'null'];

        $list = $model->alias('a')
            ->join(C('DB_PREFIX').'task as b on a.task_id = b.id','left')
            ->where($map)
            ->field('a.*,b.title')
            ->order('a.id desc')->limit("$firstRow , $listRows")
            ->select();

        foreach ($list as &$item) {
            $item['cha_time'] = $item['end_time'] - time();
        }
        // var_dump($list);die;

        $this->assign("Page", $page->show());
        $this->assign("list", $list);
        $this->assign('count', $count);

        $this->assign('title','选择提交的任务');
        $this->display();
    }

    //提交任务
    public function submission_task_do()
    {
        if( !$this->is_login() ) {
            $this->error("请先登录");
        }
        $member_id = $this->get_member_id();

        $id = I('id');
        $apply_data = M('task_apply')->find($id);
        if( $member_id != $apply_data['member_id'] ) {
            $this->error('没有权限');
        }
        if( $apply_data['status'] == 2 ) {
            $this->error('任务已完成，请勿重复提交');
        }

        if( IS_POST ) {
            $file = I('post.file');
            if( empty($file) ) {
                $this->error('请上传任务截图');
            }

            $data['id'] = $id;
            $data['file'] = $file;
            $data['update_time'] = time();
            $data['status'] = 1;//状态改为已提交
            $result = M('task_apply')->save($data);
            if($result) {
                $this->success('任务提交成功',U('submission_task'));
            } else {
                $this->error('任务提交失败');
            }
        } else {

            $task_id = $apply_data['task_id'];
            $apply_data['task_title'] = M('task')->where(array('id'=>$task_id))->getField('title');
            $apply_status = C('APPLY_STATUS');
            $apply_data['apply_status'] = $apply_status[$apply_data['status']];
            $this->assign("apply_data", $apply_data);

            $this->display();
        }
    }

    /**
     * 领取任务
     */
    public function get_task()
    {
        if( !$this->is_login() ) {
            $this->error("请先登录");
        }
        $member_id = $this->get_member_id();
        $id = intval(I('post.id'));
        if( !($id>0) ) {
            $this->error("参数错误");
        }
        $member_level = M('member')->where(array('id'=>$this->get_member_id()))->getField('level');
		
       
        $task_data = M('task')->field('level,price,max_num,apply_num,end_time')->where(array('id'=>$id))->find();

        if( $task_data['end_time']<time() ) {
            $this->error('该任务已过期');
        }

        $level_list = LevelModel::get_member_level();
        if( $member_level < $task_data['level'] ) {
            $this->error("您的会员等级不能领取{$level_list[$task_data['level']]['name']}的任务。");
        }

        //检测是否已领取
        $check_apply = M('task_apply')->where(array('task_id'=>$id,'member_id'=>$member_id))->find();
        if( $check_apply ) {
            $this->error('您已经领取过该任务了');
        }

        //检测名额
        if( $task_data['apply_num'] >= $task_data['max_num'] ) {
            $this->error("任务名额已满");
        }
      	
      	$task_limit =  M('level')->where(array('level'=>$member_level ))->getField('day_limit_task_num');
      	$today_time = strtotime(date("Ymd"));
      	$where = " create_time > $today_time and member_id=".($this->get_member_id())." ";
      	
        $task_limit_count = M('task_apply')->where( $where )->count();
      	if( $task_limit_count >= $task_limit && $task_limit > 0 )
        {
        	  $this->error('您当前的会员等级每天只能领取'.$task_limit.'个任务，您今日已经达到上限了哦！');
        }

      	// xiao5    2019年7月9日16:41:27   信用分低于200，每天只能报名完成10次任务
//        $where .= " and status = 2";
      	$point_limit_count = M('task_apply')->where( $where )->count();
      	$point_set = M('point_set')->field('renwu_count, renwu_point')->find();
      	$member_point = M('member')->where(['id' => $member_id])->getField('point');
//      	var_dump($member_point < $point_set['renwu_point'] && $point_limit_count >= $point_set['renwu_count']);die;
      	if ($member_point < $point_set['renwu_point'] && $point_limit_count >= $point_set['renwu_count']) {
            $this->error('信用分低于' . $point_set['renwu_point'] . '，每天只能报名完成' . $point_set['renwu_count'] . '次任务');
        }

        //写入数据
        $time = time();
        $data['task_id'] = $id;
        $data['member_id'] = $member_id;
        $data['price'] = $task_data['price'];
        $data['status'] = 0;
        $data['create_time'] = $time;
        $data['update_time'] = $time;
        $data['end_time'] = $task_data['end_time'];
        $result = M('task_apply')->add($data);
        if( $result ) {
            M('task')->where(array('id'=>$id))->setInc('apply_num',1);
            $this->success('任务领取成功');
        } else {
            $this->error("领取失败");
        }
    }

    public function showw()
    {
        $id = I('id');
        $show = M('page')->where(['id' => $id])->find();
        $this->assign('title', $show['title']);
        $this->assign('show', $show);
        $this->display();
    }

    /**
     * xiao5    2019年7月10日13:43:31  放弃任务
     */
    public function abandon()
    {
        $id = I('id');

        $res = M('task_apply')->where(['id' => $id])->save(['status' => -2, 'is_end' => 1]);
        if ($res) {
            $this->ajaxReturn(['status' => 1, 'msg' => '操作成功']);
        } else {
            $this->ajaxReturn(['status' => 0, 'msg' => '操作失败']);
        }
    }


    //发布任务
    /**
     * 添加、编辑操作
     */
    public function handle() {
        $model = M ('task');

        $member = M('member')->find($this->get_member_id());
        $this->assign ( 'member', $member );
        $this->assign ( 'server_money', C('Server_Money') );

        $cate_list = M('Category')->field('*')->where(array('is_show'=>1))->order('order_number')->select();
        $this->assign('cate_list', $cate_list);

        if( IS_POST ) {
            $data = I('post.');
            $data['uid'] = $this->get_member_id();

            $data['tushi'] = isset($data['tushi']) && !empty($data['tushi']) ? serialize($data['tushi']) : ''; //图示案例
            $step_imgCount = $step_descCount = 0;
            if (isset($data['step_img']) && is_array($data['step_img'])) {
                $step_imgCount = count($data['step_img']);
            }
            if (isset($data['step_desc']) && is_array($data['step_desc'])) {
                $step_descCount = count($data['step_desc']);
            }
            if ($step_descCount > 0) {
                $data['step_info'] = array(
                   'step_desc' =>$data['step_desc'],
                   'step_img'  =>$data['step_img'],
                );
                $data['step_info'] = serialize($data['step_info']);
            }
            unset($data['step_desc']);
            unset($data['step_img']);

            foreach($data as $key=>$val){
                if(is_array($val)){
                    $data[$key] = implode(',', $val);
                }
            }

            if ( empty($data['title']) ){
                $this->error ('新增失败!');
            }

            $id = $data[$model->getPk ()];
            if( isset($data['content']) ) $data['content'] = I('content','',false);
            $data['end_time'] = strtotime($data['end_time']." 23:59:59");
            if( !($id > 0) ) {
                $time = time();
                $data['create_time'] = $time;
                $data['update_time'] = $time;
                if ( $model->add ($data) ) {
                    //
                    $this->setMoney($data);//扣除金额

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
            //var_dump($this->get_member_id());die;
//            unset($level[3]);//不分钻石会员
            $this->assign ( 'level', $level );
            $this->assign ( 'uid', $this->member_id );
            $this->display ();
        }
    }


    public function setMoney($data)
    {
        //
        //添加金额变动记录
        $member_id = $this->get_member_id();

        $price = $data['price']*1;
        $price = $price + $price * C('Server_Money');
        $price = -$price;

        $model_member = new MemberModel();
        if( $price>0 ) {
            $mark = '发布任务消费 ID：'.session('user.id');
            $res = $model_member->incPrice($member_id,$price,98,$mark);
        } else {
            $mark = '发布任务消费 ID：'.session('user.id');
            $res = $model_member->decPrice($member_id,abs($price),101,$mark);
            M('member')->where(array('id' => $member_id))->setDec('total_price', abs($price));
        }

    }


    
    function getArray2($arr){
        if ($arr) {
            $num = 0;$num2=0;$data =[];
            foreach ($arr as $item) {
                $num++;
                $data[$num2][] = $item;
                if ($num%4==0){
                    $num2 ++;
                }
            }

            return $data;
        }
    }
    
    
    //管理
    /**
     * 列表
     */
    public function get_list() {

        if (isset($_REQUEST['start']) && !empty($_REQUEST['start'])) {
            $start = $_REQUEST['start'];
            //$map = array();
            //$map['status'] = 1;

            $map = $this->_search();
            $type = I('get.type');
            $level = I('get.level');
            if( $type!='' ) $map['type'] = $type;
            if( $level!='' ) $map['level'] = $level;
            $map['uid'] = $this->get_member_id();

            $task_list = M('task')->where($map)->order('id desc')->limit($start,10)->select();
            $task_type = C('TASK_TYPE');
            $level_list = LevelModel::get_member_level();
            $cate_list = M('Category')->field('*')->where(array('is_show'=>1))->order('order_number')->select();


            foreach( $task_list as &$_list ) {
                $_list['level_name'] = $level_list[$_list['level']]['name'];
                $_list['type_name'] = $task_type[$_list['type']];
                $_list['end_time'] = date('Y-m-d', $_list['end_time']);;
                $_list['editUrl'] = U('Task/handle',array('id'=>$_list['id']));;

                foreach ($cate_list as $it) {
                    if ($_list['cid'] == $it['id']){
                        $_list['name'] = $it['name'];
                    }
                }
            }


            header('Content-Type:application/json; charset=utf-8');
            echo json_encode((object)array('info'=>$task_list,'status'=>1));exit();
        }


        //会员等级
        $level_list = $level_list2 = LevelModel::get_member_level();
        // unset($level_list[3]);//不分钻石会员
        array_unshift($level_list,array('name'=>'全部','id'=>''));
        //$this->assign ( 'level_list', $level_list );
        $this->assign ( 'level_list', $this->getArray2($level_list) );


        $map = $this->_search();
        $type = I('get.type');
        $level = I('get.level');
        if( $type!='' ) $map['type'] = $type;
        if( $level!='' ) $map['level'] = $level;
        $map['uid'] = $this->get_member_id();

        //列表数据
        $list = $this->_list ('task', $map );
        $task_type = C('TASK_TYPE');

        $cate_list = M('Category')->field('*')->where(array('is_show'=>1))->order('order_number')->select();

        foreach( $list as &$_list ) {
            $_list['level_name'] = $level_list2[$_list['level']]['name'];
            $_list['type_name'] = $task_type[$_list['type']];

            foreach ($cate_list as $it) {
                if ($_list['cid'] == $it['id']){
                    $_list['name'] = $it['name'];
                }
            }
        }
        $this->assign('level',$level);
        $this->assign('list',$list);
        $this->assign('get',$_GET);

        $this->display();
    }

    /**
     * 构造搜索条件map
     * @return mixed
     */
    protected function _search(){
        //模糊搜索
        $keytype = I('keytype');
        $keywords = I('keywords');
        if($keywords){
            $keytype = explode(',', $keytype);
            foreach($keytype as $type){
                $map_search[trim($type)] = array('like', "%".$keywords."%");
            }
            $map_search['_logic'] = 'or';

            $map['_complex'] = $map_search;
        }
        return $map;
    }
}