<?php
namespace Common\Model;

class PayModel extends BaseModel{
    /**
     * 支付成功
     * @param $order_id
     */
    public function pay_order_success($order_id) {

    }

    /**
     * 升级VIP成功后的处理逻辑
     * @param $order_id 订单号
     * @param $platform 渠道
     * @param $platform_no 渠道单号
     */
    public function pay_vip_success($order_id,$platform,$platform_no) {

        $recharge = M('recharge')->find($order_id);
        if( empty($recharge) || $recharge['is_pay'] == 1 ) {
            return ;
        }

        //记录支付记录
        $data = array();
        $data['type'] = 1;//购买VIP
        $data['order_id'] = $order_id;
        $data['order_no'] = $recharge['order_no'];
        $data['member_id'] = $recharge['member_id'];
        $data['price'] = $recharge['price'];
        $data['create_time'] = time();
        $data['payment_type'] = $platform;
        $data['platform_no'] = $platform_no;
        M('pay')->add($data);

        //等级信息
        $member_level = LevelModel::get_member_level();


        //用户基本信息
        $member_data = M('member')->field('id,username,phone,p1,p2,p3,level')->where(array('id'=>$recharge['member_id']))->find();
        if( $member_data['level'] > 0 ) {
            //如果用户已经升过级，不再给返利 只升级会员 直接返回

            M('recharge')->where(array('id'=>$recharge['id']))->setField('is_pay',1);
            M('member')->where(array('id'=>$recharge['member_id']))->setField('level', $recharge['level']);

            //信息提示
            $noticeModel = new NoticeModel();
            $msg = sprintf(sp_cfg('vip_msg'),$member_level[$recharge['level']]['name']);
            $noticeModel->addNotice($recharge['member_id'], "恭喜您，您的VIP等级已升级为{$msg}", true, $member_data['phone']);
            return;
        }

        //更新为已支付
        M('recharge')->where(array('id'=>$recharge['id']))->setField('is_pay',1);
//        $rebate_price_1 = $member_level[$recharge['level']]['rebate_price_1']; //一级提成
//        $rebate_price_2 = $member_level[$recharge['level']]['rebate_price_2']; //二级提成
//        $rebate_price_3 = $member_level[$recharge['level']]['rebate_price_3']; //三级提成

        $p1_level = M('member')->where(['id' => $member_data['p1']])->getField('level');
        $rebate_price_1 = $member_level[$p1_level]['rebate_price_1'];

        $p2_level = M('member')->where(['id' => $member_data['p2']])->getField('level');
        $rebate_price_2 = $member_level[$p2_level]['rebate_price_2'];

        $p3_level = M('member')->where(['id' => $member_data['p3']])->getField('level');
        $rebate_price_3 = $member_level[$p3_level]['rebate_price_3'];

        //升级用户为会员
        M('member')->where(array('id'=>$recharge['member_id']))->setField('level', $recharge['level']);

        // xiao5    2019年7月9日08:42:23   更新关系表中会员等级
        M('member_guanxi')->where(array('member_id'=>$recharge['member_id']))->save(['level' => $recharge['level']]);
        M('member_guanxi')->where(array('p_id'=>$recharge['member_id']))->save(['p_level' => $recharge['level']]);

        //给直接上级返利
        if( $member_data['p1']>0 ) {
            if( $rebate_price_1>0 ) {
                $this->add_sale($order_id, $rebate_price_1, $member_data['p1'], 3, '推荐会员提成，来源用户'.$member_data['username'], $member_data['id'] );
            }
        }
        //二级返利
        if( $member_data['p2']>0 ) {
            if( $rebate_price_2>0 ) {
                $this->add_sale($order_id, $rebate_price_2, $member_data['p2'], 3, '推荐会员提成，来源用户'.$member_data['username'], $member_data['id'] );
            }
        }
        //三级返利
        if( $member_data['p3']>0 ) {
            if( $rebate_price_3>0 ) {
                $this->add_sale($order_id, $rebate_price_3, $member_data['p3'], 3, '推荐会员提成，来源用户'.$member_data['username'], $member_data['id'] );
            }
        }

        // xiao5    2019年7月9日09:06:07   四级及以上返利
        $p_users = M('member_guanxi')->where(['member_id' => $recharge['member_id'], ['dai' => ['egt', 4], 'p_level' => ['in', '2,3']]])->group('p_level')->order('dai asc')->select();
        if ($p_users) {
            if (count($p_users) == 1 || $p_users[0]['p_level'] > $p_users[1]['p_level']) {
                $rebate_price_4 = $member_level[$p_users[0]['p_level']]['rebate_price_4'];

                $this->add_sale($order_id, $rebate_price_4, $p_users[0]['p_id'], 3, '推荐会员提成，来源用户'.$member_data['username'], $member_data['id'] );
            } else {
                foreach ($p_users as $key => $p_user) {
                    if ($key == 0) {
                        $rebate_price_4 = $member_level[$p_user['p_level']]['rebate_price_4'];
                    } else {
                        $rebate_price_4 = $member_level[$p_user['p_level']]['rebate_price_4'] - $member_level[$p_users[0]['p_level']]['rebate_price_4'];
                    }
                    $this->add_sale($order_id, $rebate_price_4, $p_user['p_id'], 3, '推荐会员提成，来源用户'.$member_data['username'], $member_data['id'] );
                }
            }
        }

        //信息提示
        $noticeModel = new NoticeModel();
        $msg = sprintf(sp_cfg('vip_msg'),$member_level[$recharge['level']]['name']);
        $noticeModel->addNotice($recharge['member_id'], "恭喜您，您的VIP等级已升级为{$msg}", true, $member_data['phone']);
        return;
    }

    /**
     * 给会员添加收益
     * @param $order_id
     * @param $price
     * @param $member_id
     * @param $type
     * @param $remark
     * @param int $from_member_id
     */
    private function add_sale($order_id,$price,$member_id,$type,$remark,$from_member_id=0)
    {
        $data['member_id'] = $member_id;
        $data['from_member_id'] = $from_member_id;
        $data['order_id'] = $order_id;
        $data['price'] = $price;
        $data['remark'] = $remark;
        $data['create_time'] = time();
        $data['type'] = $type;
        $result = M('sale_list')->add($data); //收益记录
        if( $result ) {
            //添加金额变动记录
            $model_member = new MemberModel();
            $model_member->incPrice($member_id,$price,$type,$remark,$result);
        } else {
            throw_exception('添加收益失败');
        }
    }
}
