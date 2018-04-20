<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Message\Model;
use Think\Model;
class MessagesModel extends Model
{   
    CONST DATAFLAG = 0;
    public $tableName = "messages";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
     array('messageTitle','require','消息标题不能为空，请填写消息标题！'),
     array('messageType',array(1,2,3),'请选择消息类型！',2,'in'),
     array('messageContent','require','消息内容不能为空，请填写消息内容'),
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
   public function modelAddMessage()
    {   
        $Messages = D('messages');
        if(!$Messages->create())
        {
            return $Messages->getError();
        }
        else 
        {
            $Messages->add();
            return 1;
        }
    }
     /**
     * 修改消息
     */
   public function modelEditMessage()
    {   
        $Messages = D('messages');
        if(!$Messages->create())
        {
            return $Messages->getError();
        }
        else 
        {
            $Messages->save();
            return 1;
        }
    }
    /**
     * 根据文章的id查询
     */
    public function modelgetmessagebyid($messageid)
    {
        $Messages = D('messages');
        return $Messages->where(['messageid'=>$messageid,'data_flag'=>self::DATAFLAG])->find();
    }
    /**
     * 删除文章
     */
    public function modeldelete(array $data)
    {
        $Aessages = D('messages');
        return $Aessages->save($data);
    }


}