<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Offers\Model;
use Think\Model;
class OffersfeedbackModel extends Model
{   
    CONST DATAFLAG = 0;
    public $tableName = "offers_feedback";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
     array('title','require','反馈标题不能为空，请填写反馈标题！'),
     array('content','require','反馈内容不能为空，请填写反馈内容！'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'), // 对update_time字段在更新的时候写入当前时间戳
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加反馈
     */
   public function modelAddfeedback()
    {   
        $OffersFeedback = D('offers_feedback');
        if(!$OffersFeedback->create())
        {
            return $OffersFeedback->getError();
        }
        else 
        {
            $OffersFeedback->add();
            return 1;
        }
    }
    /**
     * 更爱反馈信息
     */
    public function modelEditfeedbackinfo(array $data)
    {
        $OffersFeedback = D('offers_feedback');
        return  $OffersFeedback->save($data);
          
    }
}