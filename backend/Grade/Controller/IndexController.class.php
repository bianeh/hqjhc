<?php
namespace Grade\Controller;
use \Common\Controllers\BaseController;
use Grade\Model\GradeModel;
use Product\Model\BrandsModel;
class IndexController extends BaseController {
    CONST DATAFLAG = 0;
    public function index(){
        if ($_GET) 
        {   
           $brandName = I('get.brandName');
           $createTime = I('createTime');
           $con['brandName'] = isset($brandName)&&!empty($brandName) ? ['like',"%".I('get.brandName')."%"] : '';
           $con['createTime'] = isset($createTime)&&!empty($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $Data = M('grade');
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
     * 添加档期页面
     */
    public function addgradepage()
    {   
        $BrandsModel = new BrandsModel();
        $brandslist = $BrandsModel->modelgetbrandallinfo();
        $this->assign("brandslist",$brandslist);
        $this->assign("data",$this->_data);
        $this->display();
    }
    /**
     * 修改档期页面
     */
    public function editgradepage()
    {   
        $id = I('get.id');
        $GradeModel = new GradeModel();
        $info = $GradeModel->modelgetinfobyid($id);
        $BrandsModel = new BrandsModel();
        $brandslist = $BrandsModel->modelgetbrandallinfo();
        $this->assign("brandslist",$brandslist);
        $this->assign('info',$info);
        $this->assign("data",$this->_data);
        $this->display();
    }
    /**
     * 添加档期操作
     */
    public function doAddgrade()
    {     

          $GradeModel = new GradeModel();
          $res = $GradeModel->modelAddgrade();
          if($res == 1)
          {
            $this->success('添加档期操作成功！');
          }
          else
          {
            $this->error('添加档期操作失败！');
          }
    }
    /**
     * 修改档期操作
     */
    public function doEditgrade()
    {
          $GradeModel = new GradeModel();
          $res = $GradeModel->modelEditgrade();
          if($res == 1)
          {
            $this->success('修改档期操作成功！');
          }
          else
          {
            $this->error('修改档期操作失败！');
          }
    }
    /**
     * 删除档期操作
     */
    public function delete()
    {
        $data['id'] = I('get.id');
        $data['dataFlag'] = 1;
        $GradeModel = new GradeModel();
        $res = $GradeModel->modeldelete($data);
        if($res)
        {
            $this->success("删除档期操作成功！");
        }
        else
        {
            $this->error("删除档期操作失败！");
        }

    }
}