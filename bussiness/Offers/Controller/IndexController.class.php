<?php 
namespace Offers\Controller;
use Common\Controllers\BaseController;
use Offers\Model\OffersModel;
class IndexController extends BaseController{
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
        $offerid = $this->_data['offerid'];
        $OffersModel = new OffersModel();
        $Info = $OffersModel->modelgetinfobyid($offerid);
        $this->assign('info',$Info);
        $this->display();
    }
    /**
     * 编辑供货商信息页面
     */
    public function editOfferspage()
    {
    	$offerid = I('get.offerid');
    	$OffersModel = new OffersModel();
    	$info = $OffersModel->modelgetinfobyid($offerid);
    	$this->assign('info',$info);
    	$this->assign('data',$this->_data);
    	$this->display();
    }
    /**
     * 编辑供货商信息操作
     */
    public function doEditOffers()
    {
    	$OffersModel = new OffersModel();
        $res = $OffersModel->modelEditOffer();
        if($res == 1)
        {
        	$this->success('成功修改供货商!');
        }
        else
        {
        	$this->error($res);
        }
    }
    /**
     * 重置供货商密码
     */
    public function resetpwdpage()
    {   
    	$offerid = $this->_data['offerid'];
    	$OffersModel = new OffersModel();
    	$info = $OffersModel->modelgetinfobyid($offerid);
    	$this->assign('info',$info);
    	$this->assign('data',$this->_data);
    	$this->display();

    }
    /**
     * 重置密码操作
     */
    public function doResetPwd()
    {
    	$OffersModel = new OffersModel();
        $res = $OffersModel->modelEditOffer();
        if($res == 1)
        {
        	$this->success('成功修改密码!');
        }
        else
        {
        	$this->error($res);
        }
    }
    /**
     * 删除供货商信息
     */
    public function delete()
    {
        $data['offerid'] = I('get.offerid');
        $data['dataFlag'] = 1;
        $OffersModel = new OffersModel();
        $res = $OffersModel->modelEdtiofferinfo($data);
        if($res)
        {
            $this->success("删除供货商信息操作成功！");
        }
        else
        {
            $this->error("删除供货商信息操作失败！");
        }

    }
    /**
     * 冻结微商用户信息
     */
    public function dozen()
    {
        $data['offerid'] = I('get.offerid');
        $data['status'] = 1;
        $OffersModel = new OffersModel();
        $res = $OffersModel->modelEdtiofferinfo($data);
        if($res)
        {
            $this->success('冻结供货商操作成功！');
        }
        else
        {
            $this->error('冻结供货商操作失败！');
        }
    }
     /**
     * 启用微商用户信息
     */
    public function undozen()
    {
        $data['offerid'] = I('get.offerid');
        $data['status'] = 0;
        $OffersModel = new OffersModel();
        $res = $OffersModel->modelEdtiofferinfo($data);
        if($res)
        {
            $this->success('启用供货用户操作成功！');
        }
        else
        {
            $this->error('启用供货商用户操作失败！');
        }
    } 
}