<?php
namespace Home\Controller;

use Common\Model\MemberModel;

class CrontabController
{
    /**
     * xiao5    2019年7月9日14:10:17    定时任务（未按规定时间完成任务减信用分）
     */
    public function index()
    {
        $lists = M('task_apply')->where(['end_time' => ['lt', time()], 'is_end' => 0])->select();

        foreach ($lists as $list) {
            $dec_point = M('point_set')->getField('wwc_point');
            $model_member = new MemberModel();
            $model_member->decPoint($list['member_id'], $dec_point, 4, '未在规定时间内完成任务', $no='');

            M('task_apply')->where(['id' => $list['id']])->save(['is_end' => 1, 'status' => 0]);
            echo $list['id'] . '_';
        }
    }
}