<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Common\Model;
use Think\Model;
class OffersModel extends Model{
    public $tableName = "offers";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = [
        ['loginPwd','require','密码不能为空，请填写密码！'],
        ['loginName','require','账号不能为空，请填写账号！'],
    ];
    protected $_auto=[
        ['createTime','mydate','1','callback'],
    ];
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }

    /**
     * 获取管理员信息
     */
    public function modelOffers()
    {
        $Offers = D('offers');
        $res = $Offers->select();
        if($res)
        {
            return $res;
        }
        else
        {
            return false;
        }
    }
    /**
     * 根据id获取供货商信息
     */
    public function modelOffersByid($offerid)
    {
        $Offers = D('offers');


        $res = $Offers->where(['offerid'=>$offerid])->find();
        return $res;
    }
    /**
     * 验证供货商信息是否正确
     */
    public function modelcheckuser($loginName,$loginPwd)
    {   
        $Offers = D('offers');
        return $Offers->where(['loginName'=>$loginName,'loginPwd'=>$loginPwd])->find();
    }
    /**
     * 保存cookie信息
     * @param $data
     */
    public function write_cookie(array $data)
    {  
        $cookie_data = array(
            'offerid' => $data['offerid'],
            'loginName' => $data['loginname'],
        );
        $cookie_value = json_encode($cookie_data);
        setcookie(
            'JIHUOCANGGHS',
            $cookie_value,
            time() + 14000000,
            '/'
        );
    }

    /**
     * 保存session信息
     * @param $data
     */
    public function save_session(array $data)
    {
        $sess_key = md5('SESSIONTOKENGH-' . $data['offerid']);
        $_SESSION[$sess_key] = $data;
    }
    public function init_sess_info(){
        if (isset($_COOKIE['JIHUOCANGGHS']) && $_COOKIE['JIHUOCANGGHS']) {
            $cookie_data = json_decode($_COOKIE['JIHUOCANGGHS'],true);
            if (isset($cookie_data['offerid']) && $cookie_data['offerid']) {
                //获取登录session信息
                $sess_key = md5('SESSIONTOKENGH-' . $cookie_data['offerid']);
                $sess_info = session($sess_key);
                if (isset($sess_info) && $sess_info){
                    return $sess_info;
                }
            }
        }
        return false;
    }
}