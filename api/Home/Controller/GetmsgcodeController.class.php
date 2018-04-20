<?php
namespace Home\Controller;
use Think\Controller;
class GetmsgcodeController extends Controller {
    /**
     * 获取短信验证码接口
     * @return [type] [description]
     */
    public function index()
    {   
    	$mobile = I('post.mobile');
        $msgcode = rand(100000,999999);
        $data['mobile'] = $mobile;
        $data['code'] = $msgcode;
        $data['source'] = '手机APP端注册登录获取短信';
        $data['createTime'] = date("Y-m-d H:i:s",time());
        $this->addmobileMessage($data);
        $url = "http://175.102.15.131/msg/HttpSendSM?account=laowaijia&pswd=qR5EEsWh@mkv&mobile=".$mobile."&msg=尊敬的用户".$mobile."你好,你的验证码是".$msgcode."&needstatus=true";
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        $outputex = explode(',', $output);
        $str = $outputex[1];
        $res = substr($str,0,1);
        if($res == '0')
        {   
            $response['code'] = '000008';
	    $response['msg'] = '成功获取短信！';
        }
        else {
            $response['code'] = '000007';
	    $response['msg'] = '获取短信数据失败！';
        }
        //打印获得的数据
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
	print_r(json_encode($response));
    }
    
    //插入短信数据
    public function addmobileMessage(array $data)
    {
        $MobileMessage = D('mobile_message');
        $MobileMessage->add($data);
    }
}