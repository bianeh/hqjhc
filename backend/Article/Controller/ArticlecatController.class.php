<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Article\Controller;
use \Common\Controllers\BaseController;
use \Common\Controllers\CategoryController;
use Article\Model\ArticlecatsModel;
class ArticlecatController extends BaseController{
    /**
     * 文章分类管理
     */
    public function index()
    {    
        $catgory =  new CategoryController();
        $ArticlecatModel = new ArticlecatsModel();
        $articlecats = $ArticlecatModel->modelarticlecats();
        $articlecatslist = $catgory->index($articlecats,$pid=0,$level=1,$html="&nbsp;&nbsp");
        $this->assign('articlecatslist',$articlecatslist);
        $this->display();
    }
    /**
     * 添加文章分类页面
     */
    public function addarticlecatpage()
    {   
        $catgory =  new CategoryController();
        $ArticlecatModel = new ArticlecatsModel();
        $articlecats = $ArticlecatModel->modelarticlecats();
        $articlecatslist = $catgory->index($articlecats,$pid=0,$level=1,$html="&nbsp;$nbsp");
        $this->assign('articlecatslist',$articlecatslist);
        $this->display();
    }
    /**
     * 修改文章分类页面
     */
    public function editarticlecatpage()
    {   
        $catid = I('get.catid');
        $catgory =  new CategoryController();
        $ArticlecatModel = new ArticlecatsModel();
        $data = $ArticlecatModel->modelarticlecatsbyid($catid);
        $articlecats = $ArticlecatModel->modelarticlecats();
        $articlecatslist = $catgory->index($articlecats,$pid=0,$level=1,$html="&nbsp;$nbsp");
        $this->assign('articlecatslist',$articlecatslist);
        $this->assign('data',$data);
        $this->display();
    }
    /**
     * 添加分类操作
     */
    public function doAddArticlecat()
    {   
        $ArticlecatModel = new ArticlecatsModel();
        $res = $ArticlecatModel->modelAddArticlecats();
        if($res == 1)
        {
            $this->success('文章分类添加成功！');
        }else
        {
            $this->error($res);
        }
    }
    /**
     * 修改分类操作
     */
    public function doEditArticlecat()
    {   
        $ArticlecatModel = new ArticlecatsModel();
        $res = $ArticlecatModel->modelEditArticlecats();
        if($res == 1)
        {
            $this->success('文章分类修改成功！');
        }else
        {
            $this->error($res);
        }
    }
    /**
     * 删除分类
     */
    public function delete()
    {
        $catid = I('get.catid');
        $ArticlecatModel = new ArticlecatsModel();
        $num = $ArticlecatModel->modelcheckchild($catid);
        if($num > 0)
        {
            $this->error('文章分类有子分类，请先删除子分类！');
        } 
        else {
            $res = $ArticlecatModel->modeldelete($catid);
            if($res)
            {
                $this->success('成功删除文章分类！');
            }
            else
            {
                $this->error('删除文章分类失败！');
            }
        }
    }
}