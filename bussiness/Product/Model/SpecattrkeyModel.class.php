<?php
namespace Product\Model;
use Think\Model;
class SpecattrkeyModel extends Model{
    CONST DATAFLAG = 0;
    public $tableName = "spec_attr_key";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
     array('name','require','规格标签名称不能为空！'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'),
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加规格模板
     */
   public function modelAddSpecattr()
    {   
        $Spec_attr = D('spec_attr_key');
        if(!$Spec_attr->create())
        {
            return $Spec_attr->getError();
        }
        else 
        {
            $Spec_attr->add();
            return 1;
        }
    }
   /**
    * 根据item_id搜索标签信息
    */
    public function modelgetinfobyitemid($item_id)
    {
        $Spec_attr = D('spec_attr_key');
        return $Spec_attr->where(['item_id'=>$item_id])->select();
    }
}
