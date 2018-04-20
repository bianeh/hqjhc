<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Article\Model;
use Think\Model;
class ArticlecatsModel extends Model
{
    CONST isShow = 0;
    public $tableName = "article_cats";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
     array('catName','require','分类名称不能为空，请填写分类名称！'),
     array('parentid','require','父级分类名称不能为空，请选择父级分类！'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'), // 对update_time字段在更新的时候写入当前时间戳
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加文章分类
     */
   public function modelAddArticlecats()
    {   
        $Articlecats = D('article_cats');
        if(!$Articlecats->create())
        {
            return $Articlecats->getError();
        }
        else 
        {
            $Articlecats->add();
            return 1;
        }
    }
     /**
     * 添加文章分类
     */
   public function modelEditArticlecats()
    {   
        $Articlecats = D('article_cats');
        if(!$Articlecats->create())
        {
            return $Articlecats->getError();
        }
        else 
        {
            $Articlecats->save();
            return 1;
        }
    }
    /**
     *获取所有分类信息
     */
    public function modelarticlecats()
    {
        $Articlecats = D('article_cats');
        return $Articlecats->where(['isShow'=>self::isShow])->select();
    }
    /**
     * 根据分类ID获取文章分类信息
     */
    public function modelarticlecatsbyid($catid)
    {
         $Articlecats = D('article_cats');
         return $Articlecats->where(['catid'=>$catid])->find();
    }
    /**
     * 判断文章分类下是否有子分类
     */
    public function modelcheckchild($catid)
    {
         $Articlecats = D('article_cats');
         return $Articlecats->where(['parentid'=>$catid])->count();
    }
    /**
     * 删除分类
     */
    public function modeldelete($catid)
    {
        $Articlecats = D('article_cats');
        return $Articlecats->where(['catid'=>$catid])->delete();
    }
}