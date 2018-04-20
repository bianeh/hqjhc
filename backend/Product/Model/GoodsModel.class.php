<?php
namespace Product\Model;
use Think\Model;
class GoodsModel extends Model{
    CONST dataFlag = 0;
    public $tableName = "goods";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
     array('name','require','商品名称不能为空！'),
     array('goods_price','require','请填写商品价格！'),
     array('description','require','请填写商品描述！'),
     array('marketPrice','require','请填写商品市场价格！'),
     array('number','require','请填写商品库存！'),
     array('goods_other_img1','require','请必须上传4张展示图片！'),
     array('goods_other_img2','require','请必须上传4张展示图片！'),
     array('goods_other_img3','require','请必须上传4张展示图片！'),
     array('goods_other_img4','require','请必须上传4张展示图片！'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'),
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加产品
     */
   public function modelAddGoods()
    {   
        $Goods = D('goods');
        if(!$Goods->create())
        {
            return $Goods->getError();
        }
        else 
        {
            return $Goods->add();
        }
    }
    /**
     * 修改产品
     */
   public function modelEditGoods()
    {   
        $Goods = D('goods');
        if(!$Goods->create())
        {
            return $Goods->getError();
        }
        else 
        {
            $Goods->save();
            return 1;
        }
    }
    /**
     * 根据id获取产品信息
     */
    public function modelgetinfobyid($id)
    {
        $Goods = D('goods');
        return $Goods->where(['id'=>$id,'dataFlag'=>self::dataFlag])->find();
    }
    /**
     * 审核产品
     */
    public function modelcheck(array $data)
    {
        $Goods = D('goods');
        return $Goods->save($data);
    }
    /**
     * 删除产品
     */
    public function modeldelete(array $data)
    {
        $Goods = D('goods');
        return $Goods->save($data);
    }
    /**
     * 上下架产品
     */
    public function modelupdown(array $data)
    {
        $Goods = D('goods');
        return $Goods->save($data);
    }
   
}