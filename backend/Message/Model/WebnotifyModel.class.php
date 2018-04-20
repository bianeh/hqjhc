<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Message\Model;
use Think\Model;
class WebnotifyModel extends Model
{   
    CONST DATAFLAG = 0;
    public $tableName = "web_notify";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
     array('title','require','站内信标题不能为空，请填写站内信标题！'),
     array('info','require','站内信内容不能为空，请填写站内信内容'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'),
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加消息
     */
   public function modelAddWebnotify()
    {   
        $Webnotify = D('web_notify');
        if(!$Webnotify->create())
        {
            return $Webnotify->getError();
        }
        else 
        {
            $Webnotify->add();
            return 1;
        }
    }
     /**
     * 修改消息
     */
   public function modelEditWebnotify()
    {   
        $Webnotify = D('web_notify');
        if(!$Webnotify->create())
        {
            return $Webnotify->getError();
        }
        else 
        {
            $Webnotify->save();
            return 1;
        }
    }
    /**
     * 根据文章的id查询
     */
    public function modelgetwebnotifybyid($messageid)
    {
        $Webnotify = D('web_notify');
        return $Webnotify->where(['messageid'=>$messageid,'data_flag'=>self::DATAFLAG])->find();
    }
    /**
     * 删除文章
     */
    public function modeldelete(array $data)
    {
        $Webnotify = D('web_notify');
        return $Webnotify->save($data);
    }


}