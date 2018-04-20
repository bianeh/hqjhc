<?php
namespace Ticket\Model;
use Think\Model;
class TicketModel extends Model{
	CONST DATAFLAG = 0;
	public $tableName = 'ticket';
	public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
     array('ticketName','require','优惠券名称不能为空，请填写优惠券名称！'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'),
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加优惠券信息
     */
    public function modeladdticket()
    {
           $Ticket = D('ticket');
           if(!$Ticket->create())
	        {
	            return $Ticket->getError();
	        }
	        else 
	        {
	            $Ticket->add();
	            return 1;
	        }
    }
    /**
     * 修改优惠券信息
     */
    public function modeleditticket()
    {
           $Ticket = D('ticket');
           if(!$Ticket->create())
	        {
	            return $Ticket->getError();
	        }
	        else 
	        {
	            $Ticket->save();
	            return 1;
	        }
    }
    /**
     * 根据优惠券的id来获取优惠券信息
     */
    public function modelgetticketinfobyid($ticketid)
    {
    	$Ticket = D('ticket');
    	return $Ticket->where(['ticketid'=>$ticketid,'dataFlag'=>self::DATAFLAG])->find();
    }
    /**
     * 删除优惠券
     */
    public function modeldelete(array $data)
    {
    	$Ticket = D('ticket');
    	return $Ticket->save($data);
    }
}