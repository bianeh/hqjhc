<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Article\Model;
use Think\Model;
class ArticlesModel extends Model
{   
    CONST DATAFLAG = 0;
    public $tableName = "articles";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
     array('articleTitle','require','文章标题不能为空，请填写文章标题！'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'), // 对update_time字段在更新的时候写入当前时间戳
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加文章
     */
   public function modelAddArticle()
    {   
        $Articles = D('articles');
        if(!$Articles->create())
        {
            return $Articles->getError();
        }
        else 
        {
            $Articles->add();
            return 1;
        }
    }
    /**
     * 修改文章
     */
    public function modelUpdateArticle()
    {   

        $Articles = D('articles');
        if(!$Articles->create())
        {
            return $Articles->getError();
        }
        else 
        {   
            $Articles->save();
            return 1;
        }
    }
    /**
     * 根据文章的id查询
     */
    public function modelgetarticlebyid($articleid)
    {
        $Articles = D('articles');
        return $Articles->where(['articleid'=>$articleid,'data_flag'=>self::DATAFLAG])->find();
    }
    /**
     * 删除文章
     */
    public function modeldelete(array $data)
    {
        $Articles = D('articles');
        return $Articles->save($data);
    }
    /**
     * 回收文章
     */
    public function modelrecycle($articleid,array $data)
    {
        $Articles = D('articles');
        return $Articles -> where(['articleid'=>$articleid])->save($data);
    }
    /**
     * 恢复文章
     */
    public function modelunrecycle($articleid,array $data)
    {
        $Articles = D('articles');
        return $Articles->where(['articleid'=>$articleid])->save($data);
    }

}