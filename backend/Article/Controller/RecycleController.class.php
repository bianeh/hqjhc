<?php
namespace Article\Controller;
use \Common\Controllers\BaseController;
use Article\Model\ArticlesModel;
class RecycleController extends BaseController 
{   CONST DATAFLAG = 2;
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * 文章回收列表
     */
    public function index()
    {  
        if ($_GET) 
        {   
           $articleTitle = I('get.articleTitle');
           $articleKey = I('get.articleKey');
           $isShow = I('isShow');
           $createTime = I('createTime');
           $con['articleTitle'] = isset($articleTitle)&&!empty($articleTitle) ? ['like',"%".I('get.articleTitle')."%"] : '';
           $con['articleKey'] = isset($articleKey)&&!empty($articleKey) ? ['like',"%".I('get.articleKey')."%"] : '';
           $con['isShow'] = isset($isShow)&&!empty($isShow) ? $isShow : '';
           $con['createTime'] = isset($createTime)&&!empty($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $Data = M('articles');
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
        $orderby['articleid']='desc';
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
     * 文章恢复
     */
    public function unrecycle()
    {
        $articleid = I('get.articleid');
        $data['dataFlag'] = 0;
        $data['updatestaffid'] = $this->_data['stffid'];
        $ArticlesModel = new ArticlesModel();
        $res = $ArticlesModel->modelunrecycle($articleid,$data);
        if($res)
        {
            $this->success('成功恢复！');
        }
        else
        {
            $this->error('恢复失败！');
        }

    }
}