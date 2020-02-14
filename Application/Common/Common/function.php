<?php

header("Content-type:text/html;charset=utf-8");



//获取汉字的首字母
function sp_getfirstchar($s0){
    $firstchar_ord=ord(strtoupper($s0{0}));
    if (($firstchar_ord>=65 and $firstchar_ord<=91)or($firstchar_ord>=48 and $firstchar_ord<=57)) return $s0{0};
    $s=iconv("UTF-8","gb2312", $s0);
    $asc=ord($s{0})*256+ord($s{1})-65536;
    if($asc>=-20319 and $asc<=-20284)return "A";
    if($asc>=-20283 and $asc<=-19776)return "B";
    if($asc>=-19775 and $asc<=-19219)return "C";
    if($asc>=-19218 and $asc<=-18711)return "D";
    if($asc>=-18710 and $asc<=-18527)return "E";
    if($asc>=-18526 and $asc<=-18240)return "F";
    if($asc>=-18239 and $asc<=-17923)return "G";
    if($asc>=-17922 and $asc<=-17418)return "H";
    if($asc>=-17417 and $asc<=-16475)return "J";
    if($asc>=-16474 and $asc<=-16213)return "K";
    if($asc>=-16212 and $asc<=-15641)return "L";
    if($asc>=-15640 and $asc<=-15166)return "M";
    if($asc>=-15165 and $asc<=-14923)return "N";
    if($asc>=-14922 and $asc<=-14915)return "O";
    if($asc>=-14914 and $asc<=-14631)return "P";
    if($asc>=-14630 and $asc<=-14150)return "Q";
    if($asc>=-14149 and $asc<=-14091)return "R";
    if($asc>=-14090 and $asc<=-13319)return "S";
    if($asc>=-13318 and $asc<=-12839)return "T";
    if($asc>=-12838 and $asc<=-12557)return "W";
    if($asc>=-12556 and $asc<=-11848)return "X";
    if($asc>=-11847 and $asc<=-11056)return "Y";
    if($asc>=-11055 and $asc<=-10247)return "Z";
    return null;
}

/**
 * 验证输入数据是否为合法的电子邮件
 * @param string $str 输入数据
 * @return bool
 * @since 1.0.0
 */
function is_email($str) {
    return preg_match("/^[a-z0-9-_.]+@[\da-z][\.\w-]+\.[a-z]{2,4}$/i", $str);
}


/**
 * 验证输入数据是否为合法的电话号码
 * 区号、分机号以中杠分隔，如：86-755-88888888-8231 / +86-755-88888888-8231 / 010-88888888
 * @param string $str
 * @return bool
 * @since 1.0.0
 */
function is_phone($str) {
    return preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$/",$str);

}


/**
 * 验证输入数据是否为合法的的手机号码
 * 手机号码为11位，且以130-139，150-159，170-189开头。
 * @param string $str 输入数据
 * @return bool
 * @since 1.0.0
 */
function is_tel($str) {
    return preg_match("/^((\+86)-|(86)-)?((\d{3,4})-)(\d{7,8})(-(\d{3,}))?$/",$str);
}


/**
 * 验证输入数据是否为合法的身份证号码
 * 身份证号码为15位或18位且校验和是正确的。
 * @param string $str
 * @return bool
 * @since 1.0.0
 */
function is_idcard($idcard) {
    if(strlen($idcard) != 15 && strlen($idcard) != 18) {
        return false;
    }
    if(strlen($idcard) == 15){
        $idcard = idcard_15to18($idcard);
    }
    if(idcard_checksum18($idcard)){
        return true;
    }else{
        return false;
    }
}
/**
 * 验证身份证的私有方法：计算身份证号码中的检校码
 * @param $idcard_base 身份证号码的前十七位
 * @return string
 * @since 1.0.0
 */
function idcard_verify_number($idcard_base){
    if (strlen($idcard_base) != 17){
        return false;
    }
    $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2); //debug 加权因子
    $verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'); //debug 校验码对应值
    $checksum = 0;
    for ($i = 0; $i < strlen($idcard_base); $i++){
        $checksum += substr($idcard_base, $i, 1) * $factor[$i];
    }
    $mod = $checksum % 11;
    $verify_number = $verify_number_list[$mod];
    return $verify_number;
}
/**
 * 验证身份证的私有方法：将15位身份证升级到18位
 * @param $idcard 十五位身份证号码
 * @return string
 * @since 1.0.0
 */
function idcard_15to18($idcard){
    if (strlen($idcard) != 15){
        return false;
    }else{// 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
        if (array_search(substr($idcard, 12, 3), array('996', '997', '998', '999')) !== false){
            $idcard = substr($idcard, 0, 6) . '18'. substr($idcard, 6, 15);
        }else{
            $idcard = substr($idcard, 0, 6) . '19'. substr($idcard, 6, 15);
        }
    }
    $idcard = $idcard . idcard_verify_number($idcard);
    return $idcard;
}
/**
 * 验证身份证的私有方法：18位身份证校验码有效性检查
 * @param $idcard 十八位身份证号码
 * @return bool
 * @since 1.0.0
 */
function idcard_checksum18($idcard){
    if (strlen($idcard) != 18){ return false; }
    $idcard_base = substr($idcard, 0, 17);
    if (idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))){
        return false;
    }else{
        return true;
    }
}


/**
 * 验证输入数据是否为合法的邮政编码
 * @param string $str
 * @return bool
 * @since 1.0.0
 */
function is_zipcode($str) {
    return preg_match("/^[0-9]{4,6}$/",$str);
}


/**
 * 验证输入数据是否全部是英文字母
 * @param string $str
 * @return bool
 * @since 1.0.0
 */
function is_alpha($str) {
    return preg_match("/^[a-zA-Z]*$/",$str);
}


/**
 * 验证输入数据是否全部是简体中文
 * @param string $str
 * @return bool
 * @since 1.0.0
 */
function is_chinese($str) {
    return preg_match("/^[\x80-\xff]*$/", $str);
}


/**
 * 验证输入数据是否由字母和数字组成
 * @param string $str
 * @return bool
 * @since 1.0.0
 */
function is_alpha_num($str) {
    return preg_match("/^[a-zA-Z0-9]*$/",$str);
}


/**
 * 验证输入数据是否由字母、数字、下划线组成
 * @param string $str
 * @return bool
 * @since 1.0.0
 */
function is_alpha_num_line($str) {
    return preg_match("/^[a-zA-Z0-9_]*$/",$str);
}

/**
 * 是否是微信浏览器
 * @return bool
 */
function is_wechat() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($user_agent, 'MicroMessenger') === false) {
        return false;
    } else {
        return true;
    }
}

//传递数据以易于阅读的样式格式化后输出
function p($data){
    // 定义样式
    $str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
    // 如果是boolean或者null直接显示文字；否则print
    if (is_bool($data)) {
        $show_data=$data ? 'true' : 'false';
    }elseif (is_null($data)) {
        $show_data='null';
    }else{
        $show_data=print_r($data,true);
    }
    $str.=$show_data;
    $str.='</pre>';
    echo $str;
}

/**
 * app 图片上传
 * @return string 上传后的图片名
 */
function app_upload_image($path,$maxSize=52428800){
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path,'.');
    $path=trim($path,'/');
    $config=array(
        'rootPath'  =>'./',         //文件上传保存的根路径
        'savePath'  =>'./'.$path.'/',   
        'exts'      => array('jpg', 'gif', 'png', 'jpeg','bmp'),
        'maxSize'   => $maxSize,
        'autoSub'   => true,
        );
    $upload = new \Think\Upload($config);// 实例化上传类
    $info = $upload->upload();
    if($info) {
        foreach ($info as $k => $v) {
            $data[]=trim($v['savepath'],'.').$v['savename'];
        }
        return $data;
    }
}

/**
 * 实例化阿里云oos
 * @return object 实例化得到的对象
 */
function new_oss(){
    vendor('Alioss.autoload');
    $config=C('ALIOSS_CONFIG');
    $oss=new \OSS\OssClient($config['KEY_ID'],$config['KEY_SECRET'],$config['END_POINT']);
    return $oss;
}

/**
 * 上传文件到oss并删除本地文件
 * @param  string $path 文件路径
 * @return bollear      是否上传
 */
function oss_upload($path){
    // 获取bucket名称
    $bucket=C('ALIOSS_CONFIG.BUCKET');
    // 先统一去除左侧的.或者/ 再添加./
    $oss_path=ltrim($path,'./');
    $path='./'.$oss_path;
    if (file_exists($path)) {
        // 实例化oss类
        $oss=new_oss();
        // 上传到oss    
        $oss->uploadFile($bucket,$oss_path,$path);
        // 如需上传到oss后 自动删除本地的文件 则删除下面的注释 
        // unlink($path);
        return true;
    }
    return false;
}

/**
 * 删除oss上指定文件
 * @param  string $object 文件路径 例如删除 /Public/README.md文件  传Public/README.md 即可
 */
function oss_delet_object($object){
    // 实例化oss类
    $oss=new_oss();
    // 获取bucket名称
    $bucket=C('ALIOSS_CONFIG.BUCKET');
    $test=$oss->deleteObject($bucket,$object);
}

/**
 * app 视频上传
 * @return string 上传后的视频名
 */
function app_upload_video($path,$maxSize=52428800){
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path,'.');
    $path=trim($path,'/');
    $config=array(
        'rootPath'  =>'./',         //文件上传保存的根路径
        'savePath'  =>'./'.$path.'/',   
        'exts'      => array('mp4','avi','3gp','rmvb','gif','wmv','mkv','mpg','vob','mov','flv','swf','mp3','ape','wma','aac','mmf','amr','m4a','m4r','ogg','wav','wavpack'),
        'maxSize'   => $maxSize,
        'autoSub'   => true,
        );
    $upload = new \Think\Upload($config);// 实例化上传类
    $info = $upload->upload();
    if($info) {
        foreach ($info as $k => $v) {
            $data[]=trim($v['savepath'],'.').$v['savename'];
        }
        return $data;
    }
}


/**
 * 返回文件格式
 * @param  string $str 文件名
 * @return string      文件格式
 */
function file_format($str){
    // 取文件后缀名
    $str=strtolower(pathinfo($str, PATHINFO_EXTENSION));
    // 图片格式
    $image=array('webp','jpg','png','ico','bmp','gif','tif','pcx','tga','bmp','pxc','tiff','jpeg','exif','fpx','svg','psd','cdr','pcd','dxf','ufo','eps','ai','hdri');
    // 视频格式
    $video=array('mp4','avi','3gp','rmvb','gif','wmv','mkv','mpg','vob','mov','flv','swf','mp3','ape','wma','aac','mmf','amr','m4a','m4r','ogg','wav','wavpack');
    // 压缩格式
    $zip=array('rar','zip','tar','cab','uue','jar','iso','z','7-zip','ace','lzh','arj','gzip','bz2','tz');
    // 文档格式
    $text=array('exe','doc','ppt','xls','wps','txt','lrc','wfs','torrent','html','htm','java','js','css','less','php','pdf','pps','host','box','docx','word','perfect','dot','dsf','efe','ini','json','lnk','log','msi','ost','pcs','tmp','xlsb');
    // 匹配不同的结果
    switch ($str) {
        case in_array($str, $image):
            return 'image';
            break;
        case in_array($str, $video):
            return 'video';
            break;
        case in_array($str, $zip):
            return 'zip';
            break;
        case in_array($str, $text):
            return 'text';
            break;
        default:
            return 'image';
            break;
    }
}
 
/**
 * 发送友盟推送消息
 * @param  integer  $uid   用户id
 * @param  string   $title 推送的标题
 * @return boolear         是否成功
 */
function umeng_push($uid,$title){
    // 获取token
    $device_tokens=D('OauthUser')->getToken($uid,2);
    // 如果没有token说明移动端没有登录；则不发送通知
    if (empty($device_tokens)) {
        return false;
    }
    // 导入友盟
    Vendor('Umeng.Umeng');
    // 自定义字段   根据实际环境分配；如果不用可以忽略
    $status=1;
    // 消息未读总数统计  根据实际环境获取未读的消息总数 此数量会显示在app图标右上角
    $count_number=1;
    $data=array(
        'key'=>'status',
        'value'=>"$status",
        'count_number'=>$count_number
        );
    // 判断device_token  64位表示为苹果 否则为安卓
    if(strlen($device_tokens)==64){
        $key=C('UMENG_IOS_APP_KEY');
        $timestamp=C('UMENG_IOS_SECRET');
        $umeng=new \Umeng($key, $timestamp);
        $umeng->sendIOSUnicast($data,$title,$device_tokens);
    }else{
        $key=C('UMENG_ANDROID_APP_KEY');
        $timestamp=C('UMENG_ANDROID_SECRET');
        $umeng=new \Umeng($key, $timestamp);
        $umeng->sendAndroidUnicast($data,$title,$device_tokens);
    }
    return true;
}
 

/**
 * 返回用户id
 * @return integer 用户id
 */
function get_uid(){
    return $_SESSION['user']['id'];
}

/**
 * 返回iso、Android、ajax的json格式数据
 * @param  array  $data           需要发送到前端的数据
 * @param  string  $error_message 成功或者错误的提示语
 * @param  integer $error_code    状态码： 0：成功  1：失败
 * @return string                 json格式的数据
 */
function ajax_return($data='',$error_message='成功',$error_code=1){
    $all_data=array(
        'error_code'=>$error_code,
        'error_message'=>$error_message,
        );
    if ($data!=='') {
        $all_data['data']=$data;
        // app 禁止使用和为了统一字段做的判断
        $reserved_words=array('id','title','price','product_title','product_id','product_category','product_number');
        foreach ($reserved_words as $k => $v) {
            if (array_key_exists($v, $data)) {
                echo 'app不允许使用【'.$v.'】这个键名 —— 此提示是function.php 中的ajax_return函数返回的';
                die;
            }
        }
    }
    // 如果是ajax或者app访问；则返回json数据 pc访问直接p出来
    echo json_encode($all_data);
    exit(0);
}

/**
 * 获取完整网络连接
 * @param  string $path 文件路径
 * @return string       http连接
 */
function get_url($path){
    // 如果是空；返回空
    if (empty($path)) {
        return '';
    }
    // 如果已经有http直接返回
    if (strpos($path, 'http://')!==false) {
        return $path;
    }
    // 判断是否使用了oss
    $alioss=C('ALIOSS_CONFIG');
    if (empty($alioss['KEY_ID'])) {
        return 'http://'.$_SERVER['HTTP_HOST'].$path;
    }else{
        return 'http://'.$alioss['BUCKET'].'.'.$alioss['END_POINT'].$path;
    }
    
}

/**
 * 检测是否登录
 * @return boolean 是否登录
 */
function check_login(){
    if (!empty($_SESSION['user']['id'])){
        return true;
    }else{
        return false;
    }
}

/**
 * 根据配置项获取对应的key和secret
 * @return array key和secret
 */
function get_rong_key_secret(){
    // 判断是需要开发环境还是生产环境的key
    if (C('RONG_IS_DEV')) {
        $key=C('RONG_DEV_APP_KEY');
        $secret=C('RONG_DEV_APP_SECRET');
    }else{
        $key=C('RONG_PRO_APP_KEY');
        $secret=C('RONG_PRO_APP_SECRET');
    }
    $data=array(
        'key'=>$key,
        'secret'=>$secret
        );
    return $data;
}

/**
 * 获取融云token
 * @param  integer $uid 用户id
 * @return integer      token
 */
function get_rongcloud_token($uid){
    // 从数据库中获取token
    $token=D('OauthUser')->getToken($uid,1);
    // 如果有token就返回
    if ($token) {
        return $token;
    }
    // 获取用户昵称和头像
    $user_data=M('Users')->field('username,avatar')->getById($uid);
    // 用户不存在
    if (empty($user_data)) {
        return false;
    }
    // 获取头像url格式
    $avatar=get_url($user_data['avatar']);
    // 获取key和secret
    $key_secret=get_rong_key_secret();
    // 实例化融云
    $rong_cloud=new \Org\Xb\RongCloud($key_secret['key'],$key_secret['secret']);
    // 获取token
    $token_json=$rong_cloud->getToken($uid,$user_data['username'],$avatar);
    $token_array=json_decode($token_json,true);
    // 获取token失败
    if ($token_array['code']!=200) {
        return false;
    }
    $token=$token_array['token'];
    $data=array(
        'uid'=>$uid,
        'type'=>1,
        'nickname'=>$user_data['username'],
        'head_img'=>$avatar,
        'access_token'=>$token
        );
    // 插入数据库
    $result=D('OauthUser')->addData($data);
    if ($result) {
        return $token;
    }else{
        return false;
    }
}

/**
 * 更新融云头像
 * @param  integer $uid 用户id
 * @return boolear      操作是否成功
 */
function refresh_rongcloud_token($uid){
    // 获取用户昵称和头像
    $user_data=M('Users')->field('username,avatar')->getById($uid);
    // 用户不存在
    if (empty($user_data)) {
        return false;
    }
    $avatar=get_url($user_data['avatar']);
    // 获取key和secret
    $key_secret=get_rong_key_secret();
    // 实例化融云
    $rong_cloud=new \Org\Xb\RongCloud($key_secret['key'],$key_secret['secret']);
    // 更新融云用户头像
    $result_json=$rong_cloud->userRefresh($uid,$user_data['username'],$avatar);
    $result_array=json_decode($result_json,true);
    if ($result_array['code']==200) {
        return true;
    }else{
        return false;
    }
}

/**
 * 删除指定的标签和内容
 * @param array $tags 需要删除的标签数组
 * @param string $str 数据源
 * @param string $content 是否删除标签内的内容 0保留内容 1不保留内容
 * @return string
 */
function strip_html_tags($tags,$str,$content=0){
    if($content){
        $html=array();
        foreach ($tags as $tag) {
            $html[]='/(<'.$tag.'.*?>[\s|\S]*?<\/'.$tag.'>)/';
        }
        $data=preg_replace($html,'',$str);
    }else{
        $html=array();
        foreach ($tags as $tag) {
            $html[]="/(<(?:\/".$tag."|".$tag.")[^>]*>)/i";
        }
        $data=preg_replace($html, '', $str);
    }
    return $data;
}

/**
 * 传递ueditor生成的内容获取其中图片的路径
 * @param  string $str 含有图片链接的字符串
 * @return array       匹配的图片数组
 */
function get_ueditor_image_path($str){
    $preg='/\/Upload\/image\/u(m)?editor\/\d*\/\d*\.[jpg|jpeg|png|bmp]*/i';
    preg_match_all($preg, $str,$data);
    return current($data);
}

/**
 * 字符串截取，支持中文和其他编码
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $suffix 截断显示字符
 * @param string $charset 编码格式
 * @return string
 */
function re_substr($str, $start=0, $length, $suffix=true, $charset="utf-8") {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']  = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    $omit=mb_strlen($str) >=$length ? '...' : '';
    return $suffix ? $slice.$omit : $slice;
}

// 设置验证码
function show_verify($config=''){
    if($config==''){
        $config=array(
            'codeSet'=>'1234567890',
            'fontSize'=>30,
            'useCurve'=>false,
            'imageH'=>60,
            'imageW'=>240,
            'length'=>4,
            'fontttf'=>'4.ttf',
            );
    }
    $verify=new \Think\Verify($config);
    return $verify->entry();
}

// 检测验证码
function check_verify($code){
    $verify=new \Think\Verify();
    return $verify->check($code);
}

/**
 * 取得根域名
 * @param type $domain 域名
 * @return string 返回根域名
 */
function get_url_to_domain($domain) {
    $re_domain = '';
    $domain_postfix_cn_array = array("com", "net", "org", "gov", "edu", "com.cn", "cn");
    $array_domain = explode(".", $domain);
    $array_num = count($array_domain) - 1;
    if ($array_domain[$array_num] == 'cn') {
        if (in_array($array_domain[$array_num - 1], $domain_postfix_cn_array)) {
            $re_domain = $array_domain[$array_num - 2] . "." . $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
        } else {
            $re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
        }
    } else {
        $re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
    }
    return $re_domain;
}

/**
 * 按符号截取字符串的指定部分
 * @param string $str 需要截取的字符串
 * @param string $sign 需要截取的符号
 * @param int $number 如是正数以0为起点从左向右截  负数则从右向左截
 * @return string 返回截取的内容
 */
/*  示例
    $str='123/456/789';
    cut_str($str,'/',0);  返回 123
    cut_str($str,'/',-1);  返回 789
    cut_str($str,'/',-2);  返回 456
    具体参考 http://www.baijunyao.com/index.php/Home/Index/article/aid/18
*/
function cut_str($str,$sign,$number){
    $array=explode($sign, $str);
    $length=count($array);
    if($number<0){
        $new_array=array_reverse($array);
        $abs_number=abs($number);
        if($abs_number>$length){
            return 'error';
        }else{
            return $new_array[$abs_number-1];
        }
    }else{
        if($number>=$length){
            return 'error';
        }else{
            return $array[$number];
        }
    }
}

/**
 * 发送邮件
 * @param  string $address 需要发送的邮箱地址 发送给多个地址需要写成数组形式
 * @param  string $subject 标题
 * @param  string $content 内容
 * @return boolean       是否成功
 */
function send_email($address,$subject,$content){
    $email_smtp=C('EMAIL_SMTP');
    $email_username=C('EMAIL_USERNAME');
    $email_password=C('EMAIL_PASSWORD');
    $email_from_name=C('EMAIL_FROM_NAME');
    $email_smtp_secure=C('EMAIL_SMTP_SECURE');
    $email_port=C('EMAIL_PORT');
    if(empty($email_smtp) || empty($email_username) || empty($email_password) || empty($email_from_name)){
        return array("error"=>1,"message"=>'邮箱配置不完整');
    }
    require_once './ThinkPHP/Library/Org/Nx/class.phpmailer.php';
    require_once './ThinkPHP/Library/Org/Nx/class.smtp.php';
    $phpmailer=new \Phpmailer();
    // 设置PHPMailer使用SMTP服务器发送Email
    $phpmailer->IsSMTP();
    // 设置设置smtp_secure
    $phpmailer->SMTPSecure=$email_smtp_secure;
    // 设置port
    $phpmailer->Port=$email_port;
    // 设置为html格式
    $phpmailer->IsHTML(true);
    // 设置邮件的字符编码'
    $phpmailer->CharSet='UTF-8';
    // 设置SMTP服务器。
    $phpmailer->Host=$email_smtp;
    // 设置为"需要验证"
    $phpmailer->SMTPAuth=true;
    // 设置用户名
    $phpmailer->Username=$email_username;
    // 设置密码
    $phpmailer->Password=$email_password;
    // 设置邮件头的From字段。
    $phpmailer->From=$email_username;
    // 设置发件人名字
    $phpmailer->FromName=$email_from_name;
    // 添加收件人地址，可以多次使用来添加多个收件人
    if(is_array($address)){
        foreach($address as $addressv){
            $phpmailer->AddAddress($addressv);
        }
    }else{
        $phpmailer->AddAddress($address);
    }
    // 设置邮件标题
    $phpmailer->Subject=$subject;
    // 设置邮件正文
    $phpmailer->Body=$content;
    // 发送邮件。
    if(!$phpmailer->Send()) {
        $phpmailererror=$phpmailer->ErrorInfo;
        return array("error"=>1,"message"=>$phpmailererror);
    }else{
        return array("error"=>0);
    }
}

/**
 * 获取一定范围内的随机数字
 * 跟rand()函数的区别是 位数不足补零 例如
 * rand(1,9999)可能会得到 465
 * rand_number(1,9999)可能会得到 0465  保证是4位的
 * @param integer $min 最小值
 * @param integer $max 最大值
 * @return string
 */
function rand_number ($min=1, $max=9999) {
    return sprintf("%0".strlen($max)."d", mt_rand($min,$max));
}

/**
 * 生成一定数量的随机数，并且不重复
 * @param integer $number 数量
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @return string
 */
function build_count_rand ($number,$length=4,$mode=1) {
    if($mode==1 && $length<strlen($number) ) {
        //不足以生成一定数量的不重复数字
        return false;
    }
    $rand   =  array();
    for($i=0; $i<$number; $i++) {
        $rand[] = rand_string($length,$mode);
    }
    $unqiue = array_unique($rand);
    if(count($unqiue)==count($rand)) {
        return $rand;
    }
    $count   = count($rand)-count($unqiue);
    for($i=0; $i<$count*3; $i++) {
        $rand[] = rand_string($length,$mode);
    }
    $rand = array_slice(array_unique ($rand),0,$number);
    return $rand;
}

/**
 * 生成不重复的随机数
 * @param  int $start  需要生成的数字开始范围
 * @param  int $end 结束范围
 * @param  int $length 需要生成的随机数个数
 * @return array       生成的随机数
 */
function get_rand_number($start=1,$end=10,$length=4){
    $connt=0;
    $temp=array();
    while($connt<$length){
        $temp[]=rand($start,$end);
        $data=array_unique($temp);
        $connt=count($data);
    }
    sort($data);
    return $data;
}

/**
 * 实例化page类
 * @param  integer  $count 总数
 * @param  integer  $limit 每页数量
 * @return subject       page类
 */
function new_page($count,$limit=10){
    return new \Org\Nx\Page($count,$limit);
}

/**
 * 获取分页数据
 * @param  subject  $model  model对象
 * @param  array    $map    where条件
 * @param  string   $order  排序规则
 * @param  integer  $limit  每页数量
 * @return array            分页数据
 */
function get_page_data($model,$map,$order='',$limit=10){
    $count=$model
        ->where($map)
        ->count();
    $page=new_page($count,$limit);
    // 获取分页数据
    $list=$model
            ->where($map)
            ->order($order)
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
    $data=array(
        'data'=>$list,
        'page'=>$page->show()
        );
    return $data;
}

/**
 * 处理post上传的文件；并返回路径
 * @param  string $path    字符串 保存文件路径示例： /Upload/image/
 * @param  string $format  文件格式限制
 * @param  string $maxSize 允许的上传文件最大值 52428800
 * @return array           返回ajax的json格式数据
 */
function post_upload($path='file',$format='empty',$maxSize='52428800'){
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path,'/');
    // 添加Upload根目录
    $path=strtolower(substr($path, 0,6))==='upload' ? ucfirst($path) : 'Upload/'.$path;
    // 上传文件类型控制
    $ext_arr= array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'photo' => array('jpg', 'jpeg', 'png'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2','pdf')
        );
    if(!empty($_FILES)){
        // 上传文件配置
        $config=array(
                'maxSize'   =>  $maxSize,       //   上传文件最大为50M
                'rootPath'  =>  './',           //文件上传保存的根路径
                'savePath'  =>  './'.$path.'/',         //文件上传的保存路径（相对于根路径）
                'saveName'  =>  array('uniqid',''),     //上传文件的保存规则，支持数组和字符串方式定义
                'autoSub'   =>  true,                   //  自动使用子目录保存上传文件 默认为true
                'exts'    =>    isset($ext_arr[$format])?$ext_arr[$format]:'',
            );
        // 实例化上传
        $upload=new \Think\Upload($config);
        // 调用上传方法
        $info=$upload->upload();
        $data=array();
        if(!$info){
            // 返回错误信息
            $error=$upload->getError();
            $data['error_info']=$error;
            return $data;
        }else{
            // 返回成功信息
            foreach($info as $file){
                $data['name']=trim($file['savepath'].$file['savename'],'.');
                return $data;
            }               
        }
    }
}

/**
 * 上传文件类型控制   此方法仅限ajax上传使用
 * @param  string   $path    字符串 保存文件路径示例： /Upload/image/
 * @param  string   $format  文件格式限制
 * @param  integer  $maxSize 允许的上传文件最大值 52428800
 * @return booler       返回ajax的json格式数据
 */
function upload($path='file',$format='empty',$maxSize='52428800'){
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path,'/');
    // 添加Upload根目录
    $path=strtolower(substr($path, 0,6))==='upload' ? ucfirst($path) : 'Upload/'.$path;
    // 上传文件类型控制
    $ext_arr= array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'photo' => array('jpg', 'jpeg', 'png'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2','pdf')
        );
    if(!empty($_FILES)){
        // 上传文件配置
        $config=array(
                'maxSize'   =>  $maxSize,       //   上传文件最大为50M
                'rootPath'  =>  './',           //文件上传保存的根路径
                'savePath'  =>  './'.$path.'/',         //文件上传的保存路径（相对于根路径）
                'saveName'  =>  array('uniqid',''),     //上传文件的保存规则，支持数组和字符串方式定义
                'autoSub'   =>  true,                   //  自动使用子目录保存上传文件 默认为true
                'exts'    =>    isset($ext_arr[$format])?$ext_arr[$format]:'',
            );
        // 实例化上传
        $upload=new \Think\Upload($config);
        // 调用上传方法
        $info=$upload->upload();
        $data=array();
        if(!$info){
            // 返回错误信息
            $error=$upload->getError();
            $data['error_info']=$error;
            echo json_encode($data);
        }else{
            // 返回成功信息
            foreach($info as $file){
                $data['name']=trim($file['savepath'].$file['savename'],'.');
                echo json_encode($data);
            }               
        }
    }
}

/**
 * 使用curl获取远程数据
 * @param  string $url url连接
 * @return string      获取到的数据
 */
function curl_get_contents($url){
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);                //设置访问的url地址
    // curl_setopt($ch,CURLOPT_HEADER,1);               //是否显示头部信息
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);               //设置超时
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);   //用户访问代理 User-Agent
    curl_setopt($ch, CURLOPT_REFERER,$_SERVER['HTTP_HOST']);        //设置 referer
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);          //跟踪301
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        //返回结果
    $r=curl_exec($ch);
    curl_close($ch);
    return $r;
}

/*
* 计算星座的函数 string get_zodiac_sign(string month, string day)
* 输入：月份，日期
* 输出：星座名称或者错误信息
*/

function get_zodiac_sign($month, $day)
{
    // 检查参数有效性
    if ($month < 1 || $month > 12 || $day < 1 || $day > 31)
        return (false);
        // 星座名称以及开始日期
        $signs = array(
        array( "20" => "水瓶座"),
        array( "19" => "双鱼座"),
        array( "21" => "白羊座"),
        array( "20" => "金牛座"),
        array( "21" => "双子座"),
        array( "22" => "巨蟹座"),
        array( "23" => "狮子座"),
        array( "23" => "处女座"),
        array( "23" => "天秤座"),
        array( "24" => "天蝎座"),
        array( "22" => "射手座"),
        array( "22" => "摩羯座")
    );
    list($sign_start, $sign_name) = each($signs[(int)$month-1]);
    if ($day < $sign_start)
    list($sign_start, $sign_name) = each($signs[($month -2 < 0) ? $month = 11: $month -= 2]);
    return $sign_name;
}

/**
 * 发送 容联云通讯 验证码
 * @param  int $phone 手机号
 * @param  int $code  验证码
 * @return boole      是否发送成功
 */
function send_sms_code($phone,$code){
    //请求地址，格式如下，不需要写https://
    $serverIP='app.cloopen.com';
    //请求端口
    $serverPort='8883';
    //REST版本号
    $softVersion='2013-12-26';
    //主帐号
    $accountSid=C('RONGLIAN_ACCOUNT_SID');
    //主帐号Token
    $accountToken=C('RONGLIAN_ACCOUNT_TOKEN');
    //应用Id
    $appId=C('RONGLIAN_APPID');
    //应用Id
    $templateId=C('RONGLIAN_TEMPLATE_ID');
    $rest = new \Org\Xb\Rest($serverIP,$serverPort,$softVersion);
    $rest->setAccount($accountSid,$accountToken);
    $rest->setAppId($appId);
    // 发送模板短信
    $result=$rest->sendTemplateSMS($phone,array($code,5),$templateId);
    if($result==NULL) {
        return false;
    }
    if($result->statusCode!=0) {
        return  false;
    }else{
        return true;
    }
}

/**
 * 将路径转换加密
 * @param  string $file_path 路径
 * @return string            转换后的路径
 */
function path_encode($file_path){
    return rawurlencode(base64_encode($file_path));
}

/**
 * 将路径解密
 * @param  string $file_path 加密后的字符串
 * @return string            解密后的路径
 */
function path_decode($file_path){
    return base64_decode(rawurldecode($file_path));
}

/**
 * 根据文件后缀的不同返回不同的结果
 * @param  string $str 需要判断的文件名或者文件的id
 * @return integer     1:图片  2：视频  3：压缩文件  4：文档  5：其他
 */
function file_category($str){
    // 取文件后缀名
    $str=strtolower(pathinfo($str, PATHINFO_EXTENSION));
    // 图片格式
    $images=array('webp','jpg','png','ico','bmp','gif','tif','pcx','tga','bmp','pxc','tiff','jpeg','exif','fpx','svg','psd','cdr','pcd','dxf','ufo','eps','ai','hdri');
    // 视频格式
    $video=array('mp4','avi','3gp','rmvb','gif','wmv','mkv','mpg','vob','mov','flv','swf','mp3','ape','wma','aac','mmf','amr','m4a','m4r','ogg','wav','wavpack');
    // 压缩格式
    $zip=array('rar','zip','tar','cab','uue','jar','iso','z','7-zip','ace','lzh','arj','gzip','bz2','tz');
    // 文档格式
    $document=array('exe','doc','ppt','xls','wps','txt','lrc','wfs','torrent','html','htm','java','js','css','less','php','pdf','pps','host','box','docx','word','perfect','dot','dsf','efe','ini','json','lnk','log','msi','ost','pcs','tmp','xlsb');
    // 匹配不同的结果
    switch ($str) {
        case in_array($str, $images):
            return 1;
            break;
        case in_array($str, $video):
            return 2;
            break;
        case in_array($str, $zip):
            return 3;
            break;
        case in_array($str, $document):
            return 4;
            break;
        default:
            return 5;
            break;
    }
}

/**
 * 组合缩略图
 * @param  string  $file_path  原图path
 * @param  integer $size       比例
 * @return string              缩略图
 */
function get_min_image_path($file_path,$width=170,$height=170){
    $min_path=str_replace('.', '_'.$width.'_'.$height.'.', trim($file_path,'.'));
    $min_path=OSS_URL.$min_path;
    return $min_path;
} 

/**
 * 不区分大小写的in_array()
 * @param  string $str   检测的字符
 * @param  array  $array 数组
 * @return boolear       是否in_array
 */
function in_iarray($str,$array){
    $str=strtolower($str);
    $array=array_map('strtolower', $array);
    if (in_array($str, $array)) {
        return true;
    }
    return false;
}

/**
 * 传入时间戳,计算距离现在的时间
 * @param  number $time 时间戳
 * @return string     返回多少以前
 */
function word_time($time) {
    $time = (int) substr($time, 0, 10);
    $int = time() - $time;
    $str = '';
    if ($int <= 2){
        $str = sprintf('刚刚', $int);
    }elseif ($int < 60){
        $str = sprintf('%d秒前', $int);
    }elseif ($int < 3600){
        $str = sprintf('%d分钟前', floor($int / 60));
    }elseif ($int < 86400){
        $str = sprintf('%d小时前', floor($int / 3600));
    }elseif ($int < 1728000){
        $str = sprintf('%d天前', floor($int / 86400));
    }else{
        $str = date('Y-m-d H:i:s', $time);
    }
    return $str;
}

/**
 * 生成缩略图
 * @param  string  $image_path 原图path
 * @param  integer $width      缩略图的宽
 * @param  integer $height     缩略图的高
 * @return string             缩略图path
 */
function crop_image($image_path,$width=170,$height=170){
    $image_path=trim($image_path,'.');
    $min_path='.'.str_replace('.', '_'.$width.'_'.$height.'.', $image_path);
    $image = new \Think\Image();
    $image->open($image_path);
    // 生成一个居中裁剪为$width*$height的缩略图并保存
    $image->thumb($width, $height,\Think\Image::IMAGE_THUMB_CENTER)->save($min_path);
    oss_upload($min_path);
    return $min_path;
}

/**
 * 上传文件类型控制 此方法仅限ajax上传使用
 * @param  string   $path    字符串 保存文件路径示例： /Upload/image/
 * @param  string   $format  文件格式限制
 * @param  integer  $maxSize 允许的上传文件最大值 52428800
 * @return booler   返回ajax的json格式数据
 */
function ajax_upload($path='file',$output_type=0,$subName='date',$format='empty',$maxSize='52428800'){
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path,'/');
    // 添加Upload根目录
    $path=strtolower(substr($path, 0,6))==='upload' ? ucfirst($path) : 'Upload/'.$path;
    // 上传文件类型控制
    $ext_arr= array(
        'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
        'photo' => array('jpg', 'jpeg', 'png'),
        'flash' => array('swf', 'flv'),
        'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
        'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2','pdf')
    );
    if( $subName == 'date' ) {
        $subName = array('date', 'Y-m-d'); //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
    }
    if(!empty($_FILES)){
        // 上传文件配置
        $config=array(
            'maxSize'   =>  $maxSize,               // 上传文件最大为50M
            'rootPath'  =>  './',                   // 文件上传保存的根路径
            'savePath'  =>  './'.$path.'/',         // 文件上传的保存路径（相对于根路径）
            'saveName'  =>  array('uniqid',''),     // 上传文件的保存规则，支持数组和字符串方式定义
            'autoSub'   =>  true,                   // 自动使用子目录保存上传文件 默认为true
            'exts'      =>    isset($ext_arr[$format])?$ext_arr[$format]:'',
            'subName'      => $subName, //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        );
        // p($_FILES);
        // 实例化上传
        $upload=new \Think\Upload($config);
        // 调用上传方法
        $info=$upload->upload();
        // p($info);
        $data=array();
        if(!$info){
            // 返回错误信息
            $error=$upload->getError();
            $data['error_info']=$error;
            if( $output_type == 1 ) {
                return json_encode($data);
            } else {
                echo json_encode($data);
            }
        }else{

            // 返回成功信息
            foreach($info as $file){
                $data['name']=trim($file['savepath'].$file['savename'],'.');
                $data['oldname']=$file['name'];
                // p($data);
                if( $output_type == 1 ) {
                    return $data['name'];
                } else {
                    echo json_encode($data);
                }
            }
        }
    }
}

/**
 * 检测webuploader上传是否成功
 * @param  string $file_path post中的字段
 * @return boolear           是否成功
 */
function upload_success($file_path){
    // 为兼容传进来的有数组；先转成json
    $file_path=json_encode($file_path);
    // 如果有undefined说明上传失败
    if (strpos($file_path, 'undefined') !== false) {
        return false;
    }
    // 如果没有.符号说明上传失败
    if (strpos($file_path, '.') === false) {
        return false;
    }
    // 否则上传成功则返回true
    return true;
}



/**
 * 把用户输入的文本转义（主要针对特殊符号和emoji表情）
 */
function emoji_encode($str){
    if(!is_string($str))return $str;
    if(!$str || $str=='undefined')return '';

    $text = json_encode($str); //暴露出unicode
    $text = preg_replace_callback("/(\\\u[ed][0-9a-f]{3})/i",function($str){
        return addslashes($str[0]);
    },$text); //将emoji的unicode留下，其他不动，这里的正则比原答案增加了d，因为我发现我很多emoji实际上是\ud开头的，反而暂时没发现有\ue开头。
    return json_decode($text);
}

/**
 * 检测是否是手机访问
 */
function is_mobile(){
    $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';
    function _is_mobile($substrs,$text){
        foreach($substrs as $substr)
            if(false!==strpos($text,$substr)){
                return true;
            }
            return false;
    }
    $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
    $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');

    $found_mobile=_is_mobile($mobile_os_list,$useragent_commentsblock) ||
              _is_mobile($mobile_token_list,$useragent);
    if ($found_mobile){
        return true;
    }else{
        return false;
    }
}

/**
 * 将utf-16的emoji表情转为utf8文字形
 * @param  string $str 需要转的字符串
 * @return string      转完成后的字符串
 */
function escape_sequence_decode($str) {
    $regex = '/\\\u([dD][89abAB][\da-fA-F]{2})\\\u([dD][c-fC-F][\da-fA-F]{2})|\\\u([\da-fA-F]{4})/sx';
    return preg_replace_callback($regex, function($matches) {
        if (isset($matches[3])) {
            $cp = hexdec($matches[3]);
        } else {
            $lead = hexdec($matches[1]);
            $trail = hexdec($matches[2]);
            $cp = ($lead << 10) + $trail + 0x10000 - (0xD800 << 10) - 0xDC00;
        }

        if ($cp > 0xD7FF && 0xE000 > $cp) {
            $cp = 0xFFFD;
        }
        if ($cp < 0x80) {
            return chr($cp);
        } else if ($cp < 0xA0) {
            return chr(0xC0 | $cp >> 6).chr(0x80 | $cp & 0x3F);
        }
        $result =  html_entity_decode('&#'.$cp.';');
        return $result;
    }, $str);
}

/**
 * 获取当前访问的设备类型
 * @return integer 1：其他  2：iOS  3：Android
 */
function get_device_type(){
    //全部变成小写字母
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $type = 1;
    //分别进行判断
    if(strpos($agent, 'iphone')!==false || strpos($agent, 'ipad')!==false){
        $type = 2;
    } 
    if(strpos($agent, 'android')!==false){
        $type = 3;
    }
    return $type;
}

/**
 * 生成pdf
 * @param  string $html      需要生成的内容
 */
function pdf($html='<h1 style="color:red">hello word</h1>'){
    vendor('Tcpdf.tcpdf');
    $pdf = new \Tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // 设置打印模式
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('TCPDF Example 001');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    // 是否显示页眉
    $pdf->setPrintHeader(false);
    // 设置页眉显示的内容
    $pdf->SetHeaderData('logo.png', 60, 'baijunyao.com', '白俊遥博客', array(0,64,255), array(0,64,128));
    // 设置页眉字体
    $pdf->setHeaderFont(Array('dejavusans', '', '12'));
    // 页眉距离顶部的距离
    $pdf->SetHeaderMargin('5');
    // 是否显示页脚
    $pdf->setPrintFooter(true);
    // 设置页脚显示的内容
    $pdf->setFooterData(array(0,64,0), array(0,64,128));
    // 设置页脚的字体
    $pdf->setFooterFont(Array('dejavusans', '', '10'));
    // 设置页脚距离底部的距离
    $pdf->SetFooterMargin('10');
    // 设置默认等宽字体
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // 设置行高
    $pdf->setCellHeightRatio(1);
    // 设置左、上、右的间距
    $pdf->SetMargins('10', '10', '10');
    // 设置是否自动分页  距离底部多少距离时分页
    $pdf->SetAutoPageBreak(TRUE, '15');
    // 设置图像比例因子
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $pdf->setFontSubsetting(true);
    $pdf->AddPage();
    // 设置字体
    $pdf->SetFont('stsongstdlight', '', 14, '', true);
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    $pdf->Output('example_001.pdf', 'I');
}

/**
 * 生成二维码
 * @param  string  $url  url连接
 * @param  integer $size 尺寸 纯数字
 */
function qrcode($url,$size=4){
    Vendor('Phpqrcode.phpqrcode');
    QRcode::png($url,false,QR_ECLEVEL_L,$size,2,false,0xFFFFFF,0x000000);
}

/**
 * 数组转xls格式的excel文件
 * @param  array  $data      需要生成excel文件的数组
 * @param  string $filename  生成的excel文件名
 *      示例数据：
        $data = array(
            array(NULL, 2010, 2011, 2012),
            array('Q1',   12,   15,   21),
            array('Q2',   56,   73,   86),
            array('Q3',   52,   61,   69),
            array('Q4',   30,   32,    0),
           );
 */
function create_xls($data,$filename='simple.xls'){
    ini_set('max_execution_time', '0');
    Vendor('PHPExcel.PHPExcel');
    $filename=str_replace('.xls', '', $filename).'.xls';
    $phpexcel = new PHPExcel();
    $phpexcel->getProperties()
        ->setCreator("Maarten Balliauw")
        ->setLastModifiedBy("Maarten Balliauw")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");
    $phpexcel->getActiveSheet()->fromArray($data);
    $phpexcel->getActiveSheet()->setTitle('Sheet1');
    $phpexcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$filename");
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0
    $objwriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
    $objwriter->save('php://output');
    exit;
}

/**
 * 数据转csv格式的excle
 * @param  array $data      需要转的数组
 * @param  string $header   要生成的excel表头
 * @param  string $filename 生成的excel文件名
 *      示例数组：
        $data = array(
            '1,2,3,4,5',
            '6,7,8,9,0',
            '1,3,5,6,7'
            );
        $header='用户名,密码,头像,性别,手机号';
 */
function create_csv($data,$header=null,$filename='simple.csv'){
    // 如果手动设置表头；则放在第一行
    if (!is_null($header)) {
        array_unshift($data, $header);
    }
    // 防止没有添加文件后缀
    $filename=str_replace('.csv', '', $filename).'.csv';
    ob_clean();
    Header( "Content-type:  application/octet-stream ");
    Header( "Accept-Ranges:  bytes ");
    Header( "Content-Disposition:  attachment;  filename=".$filename);
    foreach( $data as $k => $v){
        // 如果是二维数组；转成一维
        if (is_array($v)) {
            $v=implode(',', $v);
        }
        // 替换掉换行
        $v=preg_replace('/\s*/', '', $v); 
        // 解决导出的数字会显示成科学计数法的问题
        $v=str_replace(',', "\t,", $v); 
        // 转成gbk以兼容office乱码的问题
        echo iconv('UTF-8','GBK',$v)."\t\r\n";
    }
}

/**
 * 导入excel文件
 * @param  string $file excel文件路径
 * @return array        excel文件内容数组
 */
function import_excel($file){
    // 判断文件是什么格式
    $type = pathinfo($file); 
    $type = strtolower($type["extension"]);
    $type=$type==='csv' ? $type : 'Excel5';
    ini_set('max_execution_time', '0');
    Vendor('PHPExcel.PHPExcel');
    // 判断使用哪种格式
    $objReader = PHPExcel_IOFactory::createReader($type);
    $objPHPExcel = $objReader->load($file); 
    $sheet = $objPHPExcel->getSheet(0); 
    // 取得总行数 
    $highestRow = $sheet->getHighestRow();     
    // 取得总列数      
    $highestColumn = $sheet->getHighestColumn(); 
    //循环读取excel文件,读取一条,插入一条
    $data=array();
    //从第一行开始读取数据
    for($j=1;$j<=$highestRow;$j++){
        //从A列读取数据
        for($k='A';$k<=$highestColumn;$k++){
            // 读取单元格
            $data[$j][]=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
        } 
    }  
    return $data;
}

/**
 * 跳向支付宝付款
 * @param  array $order 订单数据 必须包含 out_trade_no(订单号)、price(订单金额)、subject(商品名称标题)
 */
function alipay($order){
    vendor('Alipay.AlipaySubmit','','.class.php');
    // 获取配置
    $config=C('ALIPAY_CONFIG');
    $data=array(
        "_input_charset" => $config['input_charset'], // 编码格式
        "logistics_fee" => "0.00", // 物流费用
        "logistics_payment" => "SELLER_PAY", // 物流支付方式SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
        "logistics_type" => "EXPRESS", // 物流类型EXPRESS（快递）、POST（平邮）、EMS（EMS）
        "notify_url" => $config['notify_url'], // 异步接收支付状态通知的链接
        "out_trade_no" => $order['out_trade_no'], // 订单号
        "partner" => $config['partner'], // partner 从支付宝商户版个人中心获取
        "payment_type" => "1", // 支付类型对应请求时的 payment_type 参数,原样返回。固定设置为1即可
        "price" => $order['price'], // 订单价格单位为元
        // "price" => 0.01, // // 调价用于测试
        "quantity" => "1", // price、quantity 能代替 total_fee。 即存在 total_fee,就不能存在 price 和 quantity;存在 price、quantity, 就不能存在 total_fee。 （没绕明白；好吧；那无视这个参数即可）
        "receive_address" => '1', // 收货人地址 即时到账方式无视此参数即可
        "receive_mobile" => '1', // 收货人手机号码 即时到账方式无视即可
        "receive_name" => '1', // 收货人姓名 即时到账方式无视即可
        "receive_zip" => '1', // 收货人邮编 即时到账方式无视即可
        "return_url" => $config['return_url'], // 页面跳转 同步通知 页面路径 支付宝处理完请求后,当前页面自 动跳转到商户网站里指定页面的 http 路径。
        "seller_email" => $config['seller_email'], // email 从支付宝商户版个人中心获取
        "service" => "create_direct_pay_by_user", // 接口名称 固定设置为create_direct_pay_by_user
        "show_url" => $config['show_url'], // 商品展示网址,收银台页面上,商品展示的超链接。
        "subject" => $order['subject'] // 商品名称商品的标题/交易标题/订单标 题/订单关键字等
    );
    $alipay=new \AlipaySubmit($config);
    $new=$alipay->buildRequestPara($data);
    $go_pay=$alipay->buildRequestForm($new, 'get','支付');
    echo $go_pay;
}

/**
 * 微信扫码支付
 * @param  array $order 订单 必须包含支付所需要的参数 body(产品描述)、total_fee(订单金额)、out_trade_no(订单号)、product_id(产品id)
 */
function weixinpay($order){
    $order['trade_type']='NATIVE';
    Vendor('Weixinpay.Weixinpay');
    $weixinpay=new \Weixinpay();
    $weixinpay->pay($order);
}

/**
 * geetest检测验证码
 */
function geetest_chcek_verify($data){
    $geetest_id=C('GEETEST_ID');
    $geetest_key=C('GEETEST_KEY');
    $geetest=new \Org\Xb\Geetest($geetest_id,$geetest_key);
    $user_id=$_SESSION['geetest']['user_id'];
    if ($_SESSION['geetest']['gtserver']==1) {
        $result=$geetest->success_validate($data['geetest_challenge'], $data['geetest_validate'], $data['geetest_seccode'], $user_id);
        if ($result) {
            return true;
        } else{
            return false;
        }
    }else{
        if ($geetest->fail_validate($data['geetest_challenge'],$data['geetest_validate'],$data['geetest_seccode'])) {
            return true;
        }else{
            return false;
        }
    }
}


/**
 *
+--------------------------------------------------------------------
 * Description 递归创建目录
+--------------------------------------------------------------------
 * @param  string $dir 需要创新的目录
+--------------------------------------------------------------------
 * @return 若目录存在,或创建成功则返回为TRUE
+--------------------------------------------------------------------
 * @author gongwen
+--------------------------------------------------------------------
 */
function mkdirs($dir, $mode = 0777){
    if (is_dir($dir) || mkdir($dir, $mode)) return TRUE;
    if (!mkdirs(dirname($dir), $mode)) return FALSE;
    return mkdir($dir, $mode);
}


/**
 *
+--------------------------------------------------------------------
 * Description 递归删除目录
+--------------------------------------------------------------------
 * @param  string $dir 需要删除的目录
+--------------------------------------------------------------------
 * @return 若目录不存在或册除成功则返回为TRUE
+--------------------------------------------------------------------
 * @author gongwen
+--------------------------------------------------------------------
 */
function rmdirs($dir){
    if (!is_dir($dir) || rmdir($dir)) return TRUE;
    if($dir_handle=opendir($dir)){
        while($filename=readdir($dir_handle)){
            if($filename!='.' && $filename!='..'){
                $subFile=$dir.'/'.$filename;
            }
            is_dir($subFile)?rmdirs($subFile):unlink($subFile);
        }
        closedir($dir_handle);
        return rmdir($dir);
    }
}


/**
 * 获取分页信息
 * @param   $count int ：总记录数
 * @param   $page_nums int ：每页显示的记录数
 * @param   $show_header bool 显示统计信息
 * @return array
 */
function sp_get_page($count=1,$page_nums=0, $show_header = true){
    $page = new \Think\Page($count,$page_nums);// 实例化分页类 传入总记录数和每页显示的记录数
    if($show_header) {
        $page->setConfig('header', '共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页 &nbsp; ');
    } else {
        $page->setConfig('header','');
    }
    $page->setConfig('prev', '上一页');
    $page->setConfig('next', '下一页');
    $page->setConfig('last', '末页');
    $page->setConfig('first', '首页');
    $page->setConfig('theme', '<div class="page_bar">%HEADER%%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%</div>');
    $page->lastSuffix = false;//最后一页不显示为总页数
    return $page;
}

//手机版分页
function sp_get_page_m($count=1,$page_nums=0){
    $page = new \Think\Page($count,$page_nums);// 实例化分页类 传入总记录数和每页显示的记录数
    $page->setConfig('header','');
    $page->setConfig('prev', '上一页');
    $page->setConfig('next', '下一页');
    $page->setConfig('last', '末页');
    $page->setConfig('first', '首页');
    $page->setConfig('theme', '<div class="page_bar">%HEADER%%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%</div>');
    $page->lastSuffix = false;//最后一页不显示为总页数
    return $page;
}

//小说连载状态
function sp_serial_status($status) {
    $arr = array(
        '0' => '已完本',
        '1' => '连载中'
    );
    return $arr[$status];
}

//将分转换成元单位
function sp_rmb_yuan($fen) {
    $yuan = $fen / 100;
    return floatval($yuan);
}

/**
 * 图片路径处理
 * @param $str
 * @return mixed
 */
function sp_img($str) {
    if( $str == '' ) {
        $str = "/tpl/Public/images/tx/1.jpg";
    }
    return $str;
}

function sp_img_logo($str) {
    if( $str == '' ) {
        $str = "/tpl/Public/images/share_logo.png";
    }
    if( substr($str, 0, 4) != 'http' ) {
        $str = 'http://'.$_SERVER['HTTP_HOST'].$str;
    }
    return $str;
}

function sp_avatar($str) {
    if( $str == '' ) {
        $str = "http://t.cn/EbtYNT3";
    }
    return $str;
}

/**
 * VIP等级名称
 * @param $level_id
 * @return mixed
 */
function sp_level_name($level_id) {
    $level = \Common\Model\LevelModel::get_member_level();
    return $level[$level_id]['name'];
}

/**
 * 显示时间
 * @param $sTime ：时间戳
 * @param string $type
 * @return bool|string
 */
function sp_time($sTime, $type = 'normal') {
    if (!$sTime)
        return '';
    //sTime=源时间，cTime=当前时间，dTime=时间差
    $cTime      =   time();
    $dTime      =   $cTime - $sTime;
    $dDay       =   intval(date("z",$cTime)) - intval(date("z",$sTime));
    if($type=='normal'){
        if( $dTime < 60 ){
            if($dTime < 10){
                return '刚刚';
            }else{
                return intval(floor($dTime / 10) * 10)."秒前";
            }
        } elseif ( $dTime < 3600 ){
            return intval($dTime/60)."分钟前";
        } elseif ( $dTime >= 3600 && $dDay == 0  ){
            return intval($dTime/3600)."小时前";
        }/* elseif ( $dDay > 0 && $dDay<=7 ){
            return intval($dDay)."天前";
        } elseif ( $dDay > 7 &&  $dDay <= 30 ){
            return intval($dDay/7) . '周前';
        }*/ else {
            return date("Y-m-d H:i",$sTime);
        }
    }else if($type == 'ago'){
        if( $dTime <= 86400 ){
            return "今天";
        } elseif ( $dDay > 0 && $dDay<=7 ){
            return intval($dDay)."天前";
        } elseif ( $dDay > 7 &&  $dDay <= 30 ){
            return intval($dDay/7) . '周前';
        } else {
            return date("Y-m-d",$sTime);
        }
    } elseif ($type=='full'){
        return date("Y-m-d H:i:s",$sTime);
    }  elseif ($type=='hour'){
        return date("Y-m-d H:i",$sTime);
    } elseif ($type=='Ymd'){
        return date("Y-m-d",$sTime);
    } elseif ($type=='ymd'){
        return date("y-m-d",$sTime);
    } elseif ($type=='md'){
        return date("m-d",$sTime);
    } elseif ($type=='y/m/d'){
        return date("Y/m/d",$sTime);
    } else {
        return date("Y-m-d",$sTime);
    }
}


/**
 * 截取字符串
 * @param $text
 * @param $length
 * @return string
 */
function sp_subtext($text, $length){
    $text = strip_tags($text);
    if(mb_strlen($text, 'utf8') > $length)
        return mb_substr($text, 0, $length, 'utf8').'...';
    return $text;
}

/**
 * 文字长度
 * @param $text
 * @return int
 */
function sp_len($text) {
    $text = strip_tags($text);
    $len = mb_strlen($text, 'utf8');
    return $len;
}

/**
 * 获取分类广告
 * @param $cid
 * @param $limit
 * @return array
 */
function sp_get_advert($cid, $limit, $time=0) {
    if( $time!=0 ) {
        $cache_name = 'sp_get_advert_'.$cid.'_'.$limit;
        $data = S($cache_name);
        if( empty($data)) {
            $map['cid'] = $cid;
            $data = M('advert')->where($map)->limit($limit)->select();
            foreach($data as &$_data) {
                if( empty($_data['url']) ) {
                    $_data['url'] = 'javascript:';
                }
            }
            S($cache_name,$data,$time);
        }
    } else {
        $map['cid'] = $cid;
        $data = M('advert')->where($map)->limit($limit)->select();
        foreach($data as &$_data) {
            if( empty($_data['url']) ) {
                $_data['url'] = 'javascript:';
            }
        }
    }
    return $data;
}

function sp_encry($string) {
    return md5('yinyan' . $string . 'web');
}

/**
 * 验证输入数据是否为合法的日期
 * 日期格式为YYYYMMDD且有合法的分隔符(-/.) 如：1999-02-02、99/02/02、2001.12.03
 * @param string $str 输入数据
 * @param string $delimiter 分隔符,为空符合(-/.)都为true，否则需要匹配对应的分隔符
 * @return bool
 * @since 1.0.0
 */
function is_date($str,$delimiter='') {
    if( $delimiter == '' ) {
        return preg_match("/^[0-9]{4}(\-|\/|\.)[][0-9]{2}(\-|\/|\.)[0-9]{2}$/", $str);
    } else {
        return preg_match("/^[0-9]{4}".$delimiter."[][0-9]{2}".$delimiter."[0-9]{2}$/", $str);
    }
}

//根据参数重设URL
function sp_array_reset($array=array()){
    //获取当前url参数
    $re = I('get.');
    if( isset($re['p']) ) unset($re['p']);//不算分页
    foreach( $array as $k=>$v ) {
        $re[$k] = $v;
    }
    return $re;
}
function sp_array_unset($k){
    //获取当前url参数
    $re = I('get.');
    if( isset($re['p']) ) unset($re['p']);//不算分页
    if( isset($re[$k]) ) unset($re[$k]);
    return $re;
}

/**
 * 获取系统配置信息
 * @param null $key
 * @return mixed
 */
function sp_cfg($key=null) {
    return \Common\Model\SystemConfigModel::get($key);
}

/**
 * 获取一段时间内的所有日期
 * @param $begdate 2015-05-05
 * @param $enddate 2015-05-10
 * @return array
 */
function sp_date_list($begdate,$enddate){
    $begdate = strtotime($begdate);
    $enddate = strtotime($enddate);
    $tmp = array();
    for($date=$begdate;$date<=$enddate;$date+=86400){
        $tmp[] = date("Y-m-d",$date);
    }
    return $tmp;
}

/**
 * 打印输出
 * @param $data
 */
function sp_pre($data) {
    echo "<pre>";
    print_r($data);
    exit;
}

function sp_substr_cut($user_name){
    $strlen     = mb_strlen($user_name, 'utf-8');
    $firstStr     = mb_substr($user_name, 0, 1, 'utf-8');
    $lastStr     = mb_substr($user_name, -1, 1, 'utf-8');
    return $strlen == 2 ? $firstStr . str_repeat('*', mb_strlen($user_name, 'utf-8') - 1) : $firstStr . str_repeat("*", $strlen - 2) . $lastStr;
}