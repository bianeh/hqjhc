<?php
namespace Product\Controller;
use \Common\Controllers\BaseController;
use Product\Model\BrandsModel;
class BrandsController extends BaseController {
	CONST DATAFLAG=0;
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * 品牌列表
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {   
        if ($_GET) 
        {   
           $brandName = I('get.brandName');
           $brandDesc = I('get.brandDesc');
           $isShow = I('isShow');
           $createTime = I('createTime');
           $con['brandName'] = isset($brandName)&&!empty($brandName) ? ['like',"%".I('get.brandName')."%"] : '';
           $con['brandDesc'] = isset($brandDesc)&&!empty($brandDesc) ? ['like',"%".I('get.brandDesc')."%"] : '';
           $con['isShow'] = isset($isShow)&&!empty($isShow) ? $isShow : '';
           $con['createTime'] = isset($createTime)&&!empty($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $Data = M('brands');
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
        $orderby['brandid']='desc';
        $list = $Data->where($con)->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($list as $key => $value) {
            $updatestaffid = $value['updatestaffid'];
            $createstaffid = $value['createstaffid'];
            if($updatestaffid != '')
            {
                $staffModel = new \Common\Model\StaffsModel();
                $res = $staffModel ->modelStaffsByid($updatestaffid);
                $list[$key]['updatestaffname'] = $res['loginname'];
            }
            else
            {
                $list[$key]['updatestaffname'] = '';
            }
            if($createstaffid != '')
            {
                $staffModel = new \Common\Model\StaffsModel();
                $res = $staffModel ->modelStaffsByid($createstaffid);
                $list[$key]['createstaffname'] = $res['loginname'];
            }
            else
            {
                $list[$key]['createstaffname'] = '';
            }

        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    /**
     * [addbrandspage description]
     * @return [type] [description]
     */
    public function addbrandspage()
    {   
    	$this->assign('data',$this->_data);
        $this->display();
    }
    /**
     * 添加品牌操作
     * @return [type] [description]
     */
    public function doAddBrands()
    { 
    	$BrandsModel = new BrandsModel();
    	$res = $BrandsModel->modelAddBrands();
    	if($res)
    	{
    		$this->success('添加品牌成功！');
    	}
    	else
    	{
    		$this->error('添加品牌失败！');
    	}

    }
    /**
     * 修改品牌页面
     */
    public function editbrandspage()
    {   
    	$brandid = I('get.brandid');
    	$BrandsModel = new BrandsModel();
    	$info = $BrandsModel->modelgetbrandsinfobyid($brandid);
    	$this->assign('data',$this->_data);
    	$this->assign('info',$info);
    	$this->display();
    }
    /**
     * 修改品牌操作
     */
    public function doEditBrands()
    {
    	$BrandsModel = new BrandsModel();
    	$res = $BrandsModel->modelEditBrands();
    	if($res)
    	{
    		$this->success('修改品牌成功！');
    	}
    	else
    	{
    		$this->error('修改品牌失败！');
    	}

    }
    /**
     * 删除品牌信息
     */
    public function delete()
    {
    	$data['brandid'] = I('get.brandid');
    	$data['dataFlag'] = 1;
    	$data['updatestaffid'] = $this->_data['stffid'];
    	$BrandModel = new BrandsModel();
    	$res = $BrandModel->modeldelete($data);
    	if($res)
    	{
    		$this->success('成功删除品牌信息！');
    	}
    	else
    	{
    		$this->error('删除品牌信息失败！');
    	}
    }
}