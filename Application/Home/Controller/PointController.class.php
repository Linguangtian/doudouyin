<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
use Common\Model\MemberModel;

class PointController extends HomeBaseController{
    protected $member_id;

    /**
     * 初始化方法
     */
    public function _initialize(){
        parent::_initialize();

        if( !$this->is_login() ) {
            $this->redirect('Public/login');
            //$this->error('请先登陆', U('Public/login'));
        }

        $this->member_id = $this->get_member_id();
    }

    /**
     * xiao5    2019年7月8日16:17:20   信用分
     */
    public function index()
    {
        $member = M('member')->field('point, jia_point, jian_point')->where(['id' => $this->member_id])->find();
        $this->assign('member', $member);

        $sign = M('member_sign')->where(['member_id' => $this->member_id, 'create_time' => ['gt', strtotime(date('Y-m-d'))]])->find();
        if ($sign) {
            $is_sign = 1;
        } else {
            $is_sign = 0;
        }

        $this->assign('is_sign', $is_sign);

        $point_level = M('point_level')->order('point desc')->select();
        $this->assign('point_level', $point_level);

        $point_set = M('point_set')->find();
        $this->assign('point_set', $point_set);

        $total_point = M('point_level')->order('point desc')->find();
        $percent = $member['point'] / $total_point['point'] * 100;
        $this->assign('percent', $percent);

        $this->display();
    }

    public function detail()
    {
        $type = I('type', 1);
        $this->assign('type', $type);

        $type_text = array(
            '1' => '注册',
            '2' => '签到',
            '3' => '完成当日首次任务',
            '4' => '未在规定时间内完成',
            '5' => '未按要求完成',
            '6' => '管理员后台充值',
            '7' => '管理员后台减信用分',
        );

        $jia_list = M('member_point_log')->where(['member_id' => $this->member_id, 'type' => ['in', '1,2,3,6']])->order('id desc')->select();
        foreach ($jia_list as &$value) {
            $value['type_text'] = $type_text[$value['type']];
        }

        $jian_list = M('member_point_log')->where(['member_id' => $this->member_id, 'type' => ['in', '4,5,7']])->order('id desc')->select();
        foreach ($jian_list as &$item) {
            $item['type_text'] = $type_text[$item['type']];
        }

        $this->assign('jia_list', $jia_list);
        $this->assign('jian_list', $jian_list);

        $this->display();
    }

    /**
     * xiao5    2019年7月9日09:44:16   签到
     */
    public function sign_handle()
    {
        $today_time = strtotime(date('Y-m-d'));

        $model = M('member_sign');
        if ($model->where(['member_id' => $this->member_id, 'create_time' => ['gt', $today_time]])->find()) {
            $this->ajaxReturn(['status' => 0, 'msg' => '今日已签到']);
        }

        $point = M('point_set')->getField('sign_point');
        if (!empty($point)) {
            $model->add(['point' => $point, 'member_id' => $this->member_id, 'create_time' => time()]);

            $model_member = new MemberModel();
            $model_member->incPoint($this->member_id, $point, 2, '签到', $no='');
        }

        $member = M('member')->field('point, jia_point')->where(['id' => $this->member_id])->find();
        $this->ajaxReturn(['status' => 1, 'msg' => '签到成功', 'point' => $member['point'], 'jia_point' => $member['jia_point']]);
    }
}

