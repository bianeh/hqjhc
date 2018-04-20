<?php
namespace Ship\Model;
use Think\Model;
class GoodstemplateModel extends Model{
    public $tableName = "goods_template";
    public function __construct() {
        parent::__construct();
    }
    /**
     * 查询全部快递模板信息
     */
    public function modelgettemplateinfo()
    {
        $Goodstemplate = D('goods_template');
        return $Goodstemplate->where(['status'=>1])->select();
    }
   
}