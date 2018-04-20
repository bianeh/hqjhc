<?php
namespace Grade\Model;
use Think\Model;
class GradeModel extends Model{
    public $tableName = "grade";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
     array('gradeName','require','品牌列表标题不能为空！'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'),
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加档期
     */
   public function modelAddgrade()
    {   
        $Grade = D('grade');
        if(!$Grade->create())
        {
            return $Grade->getError();
        }
        else 
        {
            $Grade->add();
            return 1;
        }
    }
     /**
      * 修改档期
      */
   public function modelEditgrade()
    {   
        $Grade = D('grade');
        if(!$Grade->create())
        {
            return $Grade->getError();
        }
        else 
        {
            $Grade->save();
            return 1;
        }
    }
    /**
     * 根据档期的id查询信息
     */
    public function modelgetinfobyid($id)
    {
        $Grade = D('grade');
        return $Grade->where(['id'=>$id])->find();
    }
    /**
     * 删除档期操作
     */
    public function modeldelete(array $data)
    {
        $Grade = D('grade');
        return $Grade->save($data);
    }
}