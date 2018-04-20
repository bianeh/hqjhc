<?php
namespace Product\Model;
use Think\Model;
class GoodsspecsModel extends Model{
    CONST dataFlag =0;
    public $tableName = "goods_specs";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
     array('speca','require','规格一级名称不能为空'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'),
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加产品规格
     */
   public function modelAddGoodsspecs(array $data)
    {   
        $Goodsspecs = D('goods_specs');
        $Goodsspecs->add($data);
    }
    /**
     * 根据产品的ID获取对应的产品规格
     */
    public function modelgetinfobyid($goodsid)
    {
        $Goodsspecs = D('goods_specs');
        return $Goodsspecs->where(['goodsid'=>$goodsid,'dataFlag'=>self::dataFlag])->select();
    }
    /**
     * 删除规格
     */
    public function modeldeleteinfo($goodsid)
    {
        $Goodsspecs = D('goods_specs');
        return $Goodsspecs->where(['goodsid'=>$goodsid])->delete();
    }
   
}