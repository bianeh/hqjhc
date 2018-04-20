<?php
namespace Product\Model;
use Think\Model;
class GoodscatsModel extends Model{
    CONST DATAFLAG = 0;
    CONST PARENTIDONE = 0;
    public $tableName = "goods_cats";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
     array('catName','require','产品分类名称不能为空！'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'),
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加产品分类
     */
   public function modelAddGoodscats()
    {   
        $Goodscats = D('goods_cats');
        if(!$Goodscats->create())
        {
            return $Goodscats->getError();
        }
        else 
        {
            $Goodscats->add();
            return 1;
        }
    }
    /**
     * 修改产品分类
     */
    public function modelEditGoodscats()
    {
        $Goodscats = D('goods_cats');
        if(!$Goodscats->create())
        {
            return $Goodscats->getError();
        }
        else 
        {
            $Goodscats->save();
            return 1;
        }
    }
   /**
    * 获取产品分类信息
    */
   public function modelgoodscats()
   {
       $Goodscats = D('goods_cats');
       return $Goodscats->where(['dataFlag'=>self::DATAFLAG])->select();
   }
   /**
    * 删除产品分类
    */
   public function modeldelete(array $data)
   {
       $Goodscats = D('goods_cats');
       return $Goodscats->save($data);
   }
   /**
    * 删除之前判断有没有子分类
    */
   public function modelcheckchild($catid)
   {
        $Goodscats = D('goods_cats');
        return $Goodscats->where(['parentid'=>$catid,'dataFlag'=>self::DATAFLAG])->count();
   }
   /**
    * 根据分类ID获取分类信息
    */
   public function modelgetinfobyid($catid)
   {
         $Goodscats = D('goods_cats');
         return $Goodscats->where(['catid'=>$catid])->find();
   }
   /**
    * 获取一级分类信息
    */
   public function modelgetleveloneinfo()
   {
         $Goodscats = D('goods_cats');
         return $Goodscats->where(['dataFlag'=>self::DATAFLAG,'parentid'=>self::PARENTIDONE])->select();
   }
   /**
    * 根据catid获取子分类信息
    */
   public function modelgetchildinfobycatid($catid)
   {
         $Goodscats = D('goods_cats');
         return $Goodscats->where(['dataFlag'=>self::DATAFLAG,'parentid'=>$catid])->select();
   }

}