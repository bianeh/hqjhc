<?php
namespace Product\Model;
use Think\Model;
class BrandsModel extends Model{
    CONST DATAFLAG = 0;
    public $tableName = "brands";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
     array('brandsName','require','品牌列表标题不能为空！'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'),
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加品牌
     */
   public function modelAddBrands()
    {   
        $Brands = D('brands');
        if(!$Brands->create())
        {
            return $Brands->getError();
        }
        else 
        {
            $Brands->add();
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
}