<?php
namespace Common\Controller;
use Common\Controller\BaseController;
use Common\Model\SystemConfigModel;
/**
 * 通用基类控制器
 */
class PublicBaseController extends BaseController{
	/**
	 * 初始化方法
	 */
	public function _initialize(){
		parent::_initialize();

        $system_config = SystemConfigModel::get();
//        var_dump($system_config);die;
        $this->assign('sys_config', $system_config);

	}

}

