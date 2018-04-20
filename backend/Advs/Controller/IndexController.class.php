<?php
namespace Advs\Controller;
use \Common\Controllers\BaseController;
use Advs\Model\AdsModel;
class IndexController extends BaseController {
    CONST DATAFLAG = 0;
    public function index(){
        if ($_GET) 
        {   
           $adName = I('get.adName');
           $createTime = I('createTime');
           $con['adName'] = isset($adName)&&!empty($adName) ? ['like',"%".I('get.adName')."%"] : '';
           $con['createTime'] = isset($createTime)&&!empty($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $Data = M('ads');
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
        $orderby['adid']='desc';
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
     * 添加广告页面
     */
    public function addadvpage()
    {
        $this->assign('data',$this->_data);
        $this->display();
    }
    /**
     * 编辑广告页面
     */
    public function editadvpage()
    {   
        $adid =  I('get.adid');
        $AdsModel = new AdsModel();
        $info = $AdsModel->modelgetinfobyid($adid);
        $this->assign('info',$info);
        $this->assign('data',$this->_data);
        $this->display();
    }
    /**
     * 广告添加操作
     */
    public function doAddadv()
    {
        $AdsModel = new AdsModel();
        $res = $AdsModel->modelAddads();
        if($res == 1)
        {
          $this->success("广告添加操作成功！");
        }
        else
        {
          $this->error($res);
        }
    }
    /**
     * 广告修改操作
     */
    public function doEditadv()
    {
        $AdsModel = new AdsModel();
        $res = $AdsModel->modelEditads();
        if($res == 1)
        {
           $this->success("广告编辑操作成功！");
        }
        else
        {
           $this->error($res);
        }
    }
    /**
     * 删除广告
     */
    public function delete()
    {
        $data['adid'] = I('get.adid');
        $data['dataFlag'] = 1;
        $AdsModel = new AdsModel();
        $res = $AdsModel->modeldelete($data);
        if($res)
        {
            $this->success("删除广告操作成功！");
        }
        else
        {
            $this->error("删除广告操作失败！");
        }
    }
}