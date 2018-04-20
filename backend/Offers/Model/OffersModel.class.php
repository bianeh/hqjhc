<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Offers\Model;
use Think\Model;
class OffersModel extends Model
{   CONST DATAFLAG = 0;
    public $tableName = "offers";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
         array('loginName','require','供货商昵称不能为空，请填写供货商昵称！'),
         array('offerName','require','供货商姓名不能为空，请填写供货商姓名！'),
         array('mobile','require','供货商手机号码不能为空，请填写手机号码！'),
         array('email','email','Email格式错误！'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'),
         array("loginPwd","md5",3,"function"),
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加供货商
     */
   public function modelAddOffer()
    {   
        $Offers = D('offers');
        if(!$Offers->create())
        {
            return $Offers->getError();
        }
        else 
        {
            $Offers->add();
            return 1;
        }
    }
     /**
     * 修改供货商信息
     */
   public function modelEditOffer()
    {   
        $Offers = D('offers');
        if(!$Offers->create())
        {
            return $Offers->getError();
        }
        else 
        {
            $Offers->save();
            return 1;
        }
    }
    /**
     * 根据供货商id获取供货商信息
     */
    public function modelgetinfobyid($offerid)
    {
        $Offers = D('offers');
        return $Offers->where(['offerid'=>$offerid,'dataFlag'=>self::DATAFLAG])->find();
    }
    /**
     * 根据供货商的昵称来查数据
     */
    public function modelgetinfobyloginname($loginname)
    {
        $Offers = D('offers');
        return $Offers->where(['loginName'=>$loginname,'dataFlag'=>self::DATAFLAG])->find();
    }
    /**
     * 删除供货商
     */
    public function modeldelete(array $data)
    {
        $Offers = D('offers');
        return $Offers->save($data);
    }
}