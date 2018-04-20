<?php
namespace Product\Model;
use Think\Model;
class SpecattrvalModel extends Model{
    CONST DATAFLAG = 0;
    public $tableName = "spec_attr_val";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
     array('attr_val','require','规格值不能为空！'),
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
   public function modelAddSpecattrval()
    {   
        $Spec_attr_val = D('spec_attr_val');
        if(!$Spec_attr_val->create())
        {
            return $Spec_attr_val->getError();
        }
        else 
        {
            $Spec_attr_val->add();
            return 1;
        }
    }
    /**
     * 根据产品的ID查找产品信息
     */
    public function modelgetbrandsinfobyid($brandid)
    {
          $Brands = D('brands');
          return $Brands->where(['brandid'=>$brandid])->find();
    }
    /**
     * 修改品牌信息
     */
    public function modelEditBrands()
    {
        $Brands = D('brands');
        if(!$Brands->create())
        {
            return $Brands->getError();
        }
        else 
        {
            $Brands->save();
            return 1;
        }
    }
    /**
     * 删除品牌信息
     */
    public function modeldelete(array $data)
    {    
        $Brands = D('brands');
    	  return $Brands->save($data);
    }
    /**
     * 获取全部品牌信息
     */
    public function modelgetbrandallinfo()
    {
        $Brands = D('brands');
        return $Brands->where(['dataFlag'=>self::DATAFLAG])->select();
    }
    
     /**
    * 根据item_id搜索标签信息
    */
    public function modelgetvalinfobyitemid($item_id)
    {
        $Spec_attr = D('spec_attr_val');
        return $Spec_attr->where(['item_id'=>$item_id])->select();
    }
      /**
    * 根据attr_key_id搜索标签信息
    */
    public function modelgetvalinfobyitemvalid($attr_key_id)
    {
        $Spec_attr = D('spec_attr_val');
        return $Spec_attr->where(['attr_key_id'=>$attr_key_id])->select();
    }
}
