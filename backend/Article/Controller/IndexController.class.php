<?php
namespace Article\Controller;
use \Common\Controllers\BaseController;
use \Common\Controllers\CategoryController;
use Article\Model\ArticlecatsModel;
use Article\Model\ArticlesModel;
class IndexController extends BaseController 
{   
    CONST DATAFLAG = 0;
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * 文章列表
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
     * 添加文章页面
     */
    public function addArticlePage()
    {   
        $catgory =  new CategoryController();
        $ArticlecatModel = new ArticlecatsModel();
        $articlecats = $ArticlecatModel->modelarticlecats();
        $articlecatslist = $catgory->index($articlecats,$pid=0,$level=1,$html="&nbsp;$nbsp");
        $this->assign('data',$this->_data);
        $this->assign('articlecatslist',$articlecatslist);
        $this->display();
    }
    /**
     * 添加文章
     */
    public function doAddArticle()
    {   
        $ArticlesModel = new ArticlesModel();
        $res = $ArticlesModel->modelAddArticle();
        if($res == 1)
        {
            $this->success('文章添加成功！');
        }else
        {
            $this->error($res);
        }
    }
    /**
     * 修改文章页面
     */
    public function editArticlepage()
    {  
        $articleid = I('get.articleid');
        $catgory =  new CategoryController();
        $ArticlesModel = new ArticlesModel();
        $info = $ArticlesModel->modelgetarticlebyid($articleid);
        $ArticlecatModel = new ArticlecatsModel();
        $articlecats = $ArticlecatModel->modelarticlecats();
        $articlecatslist = $catgory->index($articlecats,$pid=0,$level=1,$html="|-");
        $this->assign('articlecatslist',$articlecats);
        $this->assign('info',$info);
        $this->assign('data',$this->_data);
        $this->display();
    }
    /**
     * 修改文章
     */
    public function doUpdateArticle()
    {
        $ArticlesModel = new ArticlesModel();
        $res = $ArticlesModel->modelUpdateArticle();
        if($res == 1)
        {
            $this->success('文章修改成功！');
        }else
        {
            $this->error($res);
        }

    }
    /**
     * 修改文章
     */
    public function doEditArticle()
    {
        $this->display();
    }
    /**
     * 删除文章
     */
    public function delete()
    {
        $data['articleid'] = I('get.articleid');
        $data['updatestaffid'] = $this->_data['stffid'];
        $data['dataFlag'] = 1;
        $ArticlesModel = new ArticlesModel();
        $res = $ArticlesModel->modeldelete($data);
        if($res)
        {
            $this->success("成功删除文章");
        }
        else
        {
            $this->error("删除文章失败！");
        }
    }
    /**
     * 文章回收
     */
    public function recycle()
    {
        $articleid = I('get.articleid');
        $data['dataFlag'] = 2;
        $data['updatestaffid'] = $this->_data['stffid'];
        $ArticlesModel = new ArticlesModel();
        $res = $ArticlesModel->modelrecycle($articleid,$data);
        if($res)
        {
            $this->success('回收成功！');
        }
        else{
            $this->error('回收失败！');
        }
    }
}