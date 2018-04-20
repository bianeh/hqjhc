<?php
namespace Advs\Model;
use Think\Model;
class AdsModel extends Model{
    public $tableName = "ads";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
     array('adName','require','广告图片名称不能为空！'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'),
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加广告
     */
   public function modelAddads()
    {   
        $Ads = D('ads');
        if(!$Ads->create())
        {
            return $Ads->getError();
        }
        else 
        {
            $Ads->add();
            return 1;
        }
    }
    /**
     * 编辑广告
     */
    public function modelEditads()
    {
        $Ads = D('ads');
        if(!$Ads->create())
        {
            return $Ads->getError();
        }
        else 
        {
            $Ads->save();
            return 1;
        }
    }
    /**
     * 根据广告ID获取广告信息
     */
    public function modelgetinfobyid($adid)
    {
        $Ads = D("ads");
        return $Ads->where(['adid'=>$adid])->find();
    }
    /**
     * 删除广告
     */
    public function modeldelete(array $data)
    {
        $Ads = D("ads");
        return $Ads->save($data);
    }
}