<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
use Org\Net\Mobile;
use Common\Model\LevelModel;
use Common\Model\SystemConfigModel;

class IndexController extends HomeBaseController{

    public function index()
    {
        if (isset($_REQUEST['start']) && !empty($_REQUEST['start'])) {
            $start = $_REQUEST['start'];
            $map = array();
            $map['status'] = 1;
            $task_list = M('task')->field('id,cid,title,level,price,create_time,max_num,apply_num,max_num-apply_num as leftnum, tasklb')->where($map)->order('id desc')->limit($start,10)->select();
            $level_list = LevelModel::get_member_level();

            $cate_list = M('Category')->field('*')->where(array('is_show'=>1))->order('order_number')->select();


            foreach ($task_list as &$item) {
                //level
                foreach ($level_list as $ite) {
                    if ($item['level'] == $ite['id']){
                        $item['levelname'] = $ite['name'];
                    }
                    if ($item['level'] == 0){
                        $item['levelname'] = '所有用户';
                    }
                }

                //cate
                foreach ($cate_list as $it) {
                    if ($item['cid'] == $it['id']){
                        $item['name'] = $it['name'];
                        $item['ico'] = $it['ico'];
                    }
                }
                empty($item['ico']) ? $item['ico'] =  sp_cfg('logo') :'';
            }

            header('Content-Type:application/json; charset=utf-8');
            echo json_encode((object)array('info'=>$task_list,'status'=>1));exit();
        }
        //判断客户端
        $dev = new Mobile();
        //AndroidOS
        if( $dev->isMobile() ) {
            if( $dev->is('iOS') ) {
                $client_dev = 'ios';
            } else {
                $client_dev = 'android';
            }
            $is_mobile = 1;
        } else {
            $client_dev = 'pc';
            $is_mobile = 0;
        }
        $this->assign('is_mobile', $is_mobile);
        $this->assign('client_dev', $client_dev);

        //记录访问的客户端信息
        // http://www.??.com?platform=app&platform_type=android&version=1.0.0
        $platform = I('get.platform');
        if( !empty($platform) ) {
            $member_client_info['platform'] = I('get.platform');
            $member_client_info['platform_type'] = $client_dev;
            $member_client_info['version'] = I('get.version');
            session('member_client_info', $member_client_info);
        } else {
            //session('member_client_info.platform_type',$client_dev);
            $member_client_info = session('member_client_info');
        }
        $this->assign('member_client_info', $member_client_info);

        $cate_list = M('Category')->field('*')->where(array('is_show'=>1))->order('order_number')->limit(10)->select();
        $this->assign('cate_list', $cate_list);

        $map = array();
        $map['status'] = 1;
        $task_list = M('task')->field('id,cid,title,level,price,create_time,max_num,apply_num,max_num-apply_num as leftnum, tasklb')->where($map)->order('id desc')->limit(10)->select();
        $level_list = LevelModel::get_member_level();
        foreach ($task_list as &$item) {
            //level
            foreach ($level_list as $ite) {
                if ($item['level'] == $ite['id']){
                    $item['levelname'] = $ite['name'];
                }
                if ($item['level'] == 0){
                    $item['levelname'] = '所有用户';
                }
            }
            //cate
            foreach ($cate_list as $it) {
                if ($item['cid'] == $it['id']){
                    $item['name'] = $it['name'];
                    $item['ico'] = $it['ico'];
                }
            }
            empty($item['ico']) ? $item['ico'] =  sp_cfg('logo') :'';
        }
 	 
        $this->assign ( 'level', $level_list );
      
        $this->assign('task_list', $task_list);

        //公告
        $page_notice_list = M('page')->field('id,title,update_time,content')->where(array('recommend2'=>1))->order('update_time asc')->find();
        //$page_notice_list['content'] = htmlspecialchars($page_notice_list['content']);
        $page_notice_list['content'] = substr(strip_tags($page_notice_list['content']),0,200);

        //var_dump($page_notice_list);die;
        $this->assign('page_notice_list', $page_notice_list);


        //未读消息
        if (session('weidu_xiaoxi') ){
            $this->assign('noticeCount', session('weidu_xiaoxi'));
        }else{
            $where = "( member_id = {$this->get_member_id()} and has_view=0 )";
            $noticeCount = M('notice')->where($where)->count('id');
            session('weidu_xiaoxi',$noticeCount);
            $this->assign('noticeCount', $noticeCount);
        }


        $title = sp_cfg('website');
        $this->assign('title', $title);

        $this->display();
    }

    /**
     * webuploader 上传文件
     */
    public function ajax_upload(){
        // 根据自己的业务调整上传路径、允许的格式、文件大小
        ajax_upload('/Uploads/images/');
    }

    /**
     * webuploader 上传demo
     */
    public function webuploader(){
        // 如果是post提交则显示上传的文件 否则显示上传页面
        if(IS_POST){
            p($_POST);die;
        }else{
            $this->display();
        }
    }

    /**
     * xiao5    2019年7月9日10:56:46   关于
     */
    public function about()
    {
        $info = SystemConfigModel::get();
        $this->assign('wx_qrcode', $info['wx_kf_qrcode']);

        $this->assign('wx_kf', $info['wx_kf']);

        $this->display();
    }


    public function serach()
    {
        $key = isset($_REQUEST['key']) ? $_REQUEST['key'] : '';
        $cid = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : '';
        $level_title = C('TASK_LEVEL');
        $level = I('get.level');

        if (isset($_REQUEST['start']) && !empty($_REQUEST['start'])) {
            $start = $_REQUEST['start'];

            $map['status'] = 1;
            $map['title']=array('like',"%$key%");
            $cid ? $map['cid'] = $cid : '';
            $task_list = M('task')->where($map)->order('id desc')->limit($start,10)->select();

            $level_list = LevelModel::get_member_level();
            $cate_list = M('Category')->field('*')->where(array('is_show'=>1))->order('order_number')->select();


            foreach ($task_list as &$item) {
                //level
                foreach ($level_list as $ite) {
                    if ($item['level'] == $ite['id']){
                        $item['levelname'] = $ite['name'];
                    }
                    if ($item['level'] == 0){
                        $item['levelname'] = '所有用户';
                    }
                }

                //cate
                foreach ($cate_list as $it) {
                    if ($item['cid'] == $it['id']){
                        $item['name'] = $it['name'];
                        $item['ico'] = $it['ico'];
                    }
                }
                $item['leftnum'] = $item['max_num'] - $item['apply_num'];
                empty($item['ico']) ? $item['ico'] =  sp_cfg('logo') :'';
            }
            header('Content-Type:application/json; charset=utf-8');
            echo json_encode((object)array('info'=>$task_list,'status'=>1));exit();

        }

        //供应信息
        //$task_list['type_0'] = M('task')->where(array('type'=>0,'status'=>1,'level'=>$level))->order('id desc')->select();
//        $task_list['type_0'] = M('task')->where(array('type'=>0,'status'=>1,'level'=>$level))->limit(5)->order('id desc')->select();
        //需求信息
        $map['status'] = 1;
        $cid ? $map['cid'] = $cid : '';
        $map['title']=array('like',"%$key%");
        $task_list = M('task')->where($map)->order('id desc')->limit(10)->select();

        $level_list = LevelModel::get_member_level();
        $cate_list = M('Category')->field('*')->where(array('is_show'=>1))->order('order_number')->limit(10)->select();


        foreach ($task_list as &$item) {
            //level
            foreach ($level_list as $ite) {
                if ($item['level'] == $ite['id']){
                    $item['levelname'] = $ite['name'];
                }
                if ($item['level'] == 0){
                    $item['levelname'] = '所有用户';
                }
            }

            //cate
            foreach ($cate_list as $it) {
                if ($item['cid'] == $it['id']){
                    $item['name'] = $it['name'];
                    $item['ico'] = $it['ico'];
                }
            }
            $item['leftnum'] = $item['max_num'] - $item['apply_num'];
            empty($item['ico']) ? $item['ico'] =  sp_cfg('logo') :'';
        }

        $this->assign('cid', $cid);
        $this->assign('cate_list', $cate_list);
        $this->assign('serach_key',$key);
        $this->assign('task_list',$task_list);
        $this->assign('title', $level!='' ? $level_title[$level] : '任务大厅');

        $cate_name = '';
        if ($cid) {
            foreach ($cate_list as $it){
                if ($cid == $it['id']) {
                    $cate_name = $it['name'];
                }
            }
        }
        if ($key)$cate_name = "搜索 ".$key.'';
        if ($cid) {

        }
        //var_dump($key);die;
        $this->assign('serachName',$cate_name);


        $this->display();

    }
}

