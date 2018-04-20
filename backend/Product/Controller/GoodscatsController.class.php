<?php
namespace Product\Controller;
use \Common\Controllers\BaseController;
use \Common\Controllers\CategoryController;
use Product\Model\GoodscatsModel;
class GoodscatsController extends BaseController {
    CONST DATAFLAG = 0;
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * 产品分类列表
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {   
        $catgory =  new CategoryController();
        $GoodscatsModel = new GoodscatsModel();
        $goodscats = $GoodscatsModel->modelgoodscats();
        $goodscatslist = $catgory->index($goodscats,$pid=0,$level=1,$html="&nbsp;&nbsp");
        $this->assign('goodscatslist',$goodscatslist);
        $this->display();
    }
    /**
     * 添加产品分类页面
     * @return [type] [description]
     */
    public function addgoodscatspage()
    {   
        $catgory =  new CategoryController();
        $GoodscatsModel = new GoodscatsModel();
        $goodscats = $GoodscatsModel->modelgoodscats();
        $goodscatslist = $catgory->index($goodscats,$pid=0,$level=1,$html="&nbsp;&nbsp");
        $this->assign('goodscatslist',$goodscatslist);
        $this->assign('data',$this->_data);
        $this->display();
    }
    /**
     * 添加产品分类
     * @return [type] [description]
     */
    public function doAddGoodscats()
    { 
        $GoodscatsModel = new GoodscatsModel();
        $res = $GoodscatsModel->modelAddGoodscats();
        if($res)
        {
            $this->success('成功添加产品分类！');
        }
        else
        {
            $this->error('添加产品分类失败！');
        }

    }
    /**
     * 删除产品分类
     * @return [type] [description]
     */
    public function delete() 
    {   
        $catid = I('get.catid');
        $GoodscatsModel = new GoodscatsModel();
        $count = $GoodscatsModel->modelcheckchild($catid);
        if($count>=1)
        {
            $this->error('改产品分类下有子分类，请先删除子分类！');
        }
        else{
             $data['catid'] = $catid;
             $data['dataFlag'] = 1;
             $res = $GoodscatsModel->modeldelete($data);
             if($res)
             {
                $this->success('成功删除！');
             }
             else
             {
                $this->error('删除失败！');
             }
        }  

    }   
    /**
     * 产品分类编辑页面
     * @return [type] [description]
     */
    public function editgoodscatspage()
    {   
        $catid = I('get.catid');
        $GoodscatsModel = new GoodscatsModel();
        $info = $GoodscatsModel->modelgetinfobyid($catid);
        $catgory =  new CategoryController();
        $GoodscatsModel = new GoodscatsModel();
        $goodscats = $GoodscatsModel->modelgoodscats();
        $goodscatslist = $catgory->index($goodscats,$pid=0,$level=1,$html="&nbsp;&nbsp");
        $this->assign('goodscatslist',$goodscatslist);
        $this->assign('info',$info);
        $this->assign('data',$this->_data);
        $this->display();
    }
    public function doEditGoodscats()
    {
        $GoodscatsModel = new GoodscatsModel();
        $res = $GoodscatsModel->modelEditGoodscats();
        if($res)
        {
            $this->success('成功修改产品分类！');
        }
        else
        {
            $this->error('修改产品分类失败！');
        }
    }
}