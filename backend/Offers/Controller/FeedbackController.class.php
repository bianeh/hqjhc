<?php 
namespace Offers\Controller;
use \Common\Controllers\BaseController;
use Offers\Model\OffersfeedbackModel;
use Offers\Model\OffersModel;
class FeedbackController extends BaseController{
	CONST DATAFLAG = 0;
	public function __construct()
	{
		parent::__construct();
	}
    /**
     * 供货商信息列表
     */
    public function index()
    {
        if ($_GET) 
        {   
           $title = I('get.title');
           $createTime = I('createTime');
           $con['title'] = isset($title) ? ['like',"%".I('get.title')."%"] : '';
           $con['createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $Data = M('offers_feedback');
        $count      = $Data->where($con)->count();  
        $Page = $Page = new \Think\Page($count, 15);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');  
        $Page->setConfig('prev', '上一页');  
        $Page->setConfig('next', '下一页');  
        $Page->setConfig('last', '末页');  
        $Page->setConfig('first', '首页');  
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');  
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $show       = $Page->show();
        $orderby['id']='desc';
        $list = $Data->where($con)->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($list as $key => $value) {
            $offerid = $value['offerid'];
            $OffersModel = new OffersModel();
            $res = $OffersModel->modelgetinfobyid($offerid);
            $list[$key]['offersname'] = $res['loginname'];
        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    /**
     * 删除反馈信息
     */
    public function delete()
    {
        $data['id'] = I('get.id');
        $data['dataFlag'] = 1;
        $OffersfeedbackModel = new OffersfeedbackModel();
        $res = $OffersfeedbackModel->modelEditfeedbackinfo($data);
        if($res)
        {
            $this->success('删除反馈信息操作成功！');
        }
        else
        {
            $this->error('删除反馈信息操作失败！');
        }
    }
}