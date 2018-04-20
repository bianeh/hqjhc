<?php
namespace Product\Controller;
use \Common\Controllers\BaseController;
use Product\Model\GoodscatsModel;
use Product\Model\GoodsModel;
use Product\Model\BrandsModel;
use Product\Model\GoodsspecsModel;
use Offers\Model\OffersModel;
class IndexController extends BaseController {
    CONST DATAFLAG = 0;
    CONST STATUS = 0;
    CONST CHECKACROSS = 1;
    CONST CHECKFAIL = 2;
    CONST UPSTATUS = 3;
    CONST DOWNSTATUS = 4;
    public function index(){
        if ($_GET) 
        {   
           $name = I('get.name');
           $code_num = I('get.code_num');
           $createTime = I('createTime');
           $con['name'] = isset($name) ? ['like',"%".I('get.name')."%"] : '';
           $con['code_num'] = isset($code_num) ? ['like',"%".I('get.code_num')."%"] : '';
           $con['createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
       
        $con['dataFlag'] = self::DATAFLAG;
        $con['status'] = self::STATUS;
        $offerid = $this->_data['offerid'];
        $con['offerid'] = $offerid;
        $Data = M('goods');
        $count      = $Data->where($con)->count();  
        $Page = new \Think\Page($count, 15);
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
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
      /**
     * 审核通过产品
     */
    public function acrosspage(){
        if ($_GET) 
        {   
           $name = I('get.name');
           $code_num = I('get.code_num');
           $createTime = I('createTime');
           $con['name'] = isset($name) ? ['like',"%".I('get.name')."%"] : '';
           $con['code_num'] = isset($code_num) ? ['like',"%".I('get.code_num')."%"] : '';
           $con['createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $con['status'] = self::CHECKACROSS;
        $offerid = $this->_data['offerid'];
        $con['offerid'] = $offerid;
        $Data = M('goods');
        $count      = $Data->where($con)->count();  
        $Page = new \Think\Page($count, 15);
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
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    /**
     * 审核未通过产品
     */
    public function failpage(){
        if ($_GET) 
        {   
           $name = I('get.name');
           $code_num = I('get.code_num');
           $createTime = I('createTime');
           $con['name'] = isset($name) ? ['like',"%".I('get.name')."%"] : '';
           $con['code_num'] = isset($code_num) ? ['like',"%".I('get.code_num')."%"] : '';
           $con['createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $con['status'] = self::CHECKFAIL;
        $offerid = $this->_data['offerid'];
        $con['offerid'] = $offerid;
        $Data = M('goods');
        $count      = $Data->where($con)->count();  
        $Page = new \Think\Page($count, 15);
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
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    /**
     * 上架产品
     */
    public function upproductpage(){
        if ($_GET) 
        {   
           $name = I('get.name');
           $code_num = I('get.code_num');
           $createTime = I('createTime');
           $con['name'] = isset($name) ? ['like',"%".I('get.name')."%"] : '';
           $con['code_num'] = isset($code_num) ? ['like',"%".I('get.code_num')."%"] : '';
           $con['createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $con['status'] = self::UPSTATUS;
        $offerid = $this->_data['offerid'];
        $con['offerid'] = $offerid;
        $Data = M('goods');
        $count      = $Data->where($con)->count();  
        $Page = new \Think\Page($count, 15);
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
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    /**
     * 下架产品
     */
    public function downproductpage(){
        if ($_GET) 
        {   
           $name = I('get.name');
           $code_num = I('get.code_num');
           $createTime = I('createTime');
           $con['name'] = isset($name) ? ['like',"%".I('get.name')."%"] : '';
           $con['code_num'] = isset($code_num) ? ['like',"%".I('get.code_num')."%"] : '';
           $con['createTime'] = isset($createTime) ? ['gt',$createTime] : '';
           $con = array_filter($con);
        }
        $con['dataFlag'] = self::DATAFLAG;
        $con['status'] = self::DOWNSTATUS;
        $offerid = $this->_data['offerid'];
        $con['offerid'] = $offerid;
        $Data = M('goods');
        $count      = $Data->where($con)->count();  
        $Page = new \Think\Page($count, 15);
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
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    
    /**
     *添加产品页面
     */
    public function addproductpage()
    {   
    	$GoodscatsModel = new GoodscatsModel();
    	$BrandsModel = new BrandsModel();
    	$goodscatslist = $GoodscatsModel->modelgetleveloneinfo();
    	$brandslist = $BrandsModel->modelgetbrandallinfo();
        $this->assign("goodstemplatelist",$goodstemplatelist);
    	$this->assign("goodscatslist",$goodscatslist);
    	$this->assign("brandslist",$brandslist);
        $this->assign("data",$this->_data);
    	$this->display();
    }
    
     /**
     * 获取产品第二级分类
     */
    public function getgoodscatschild()
    {   
    	$str = "<option value=''>请选择</option>";
    	$catid = I('post.catid');
    	$GoodscatsModel = new GoodscatsModel();
    	$info = $GoodscatsModel->modelgetchildinfobycatid($catid);
    	foreach ($info as $key => $value) {
    		$str = $str."<option class='goodscatstwo' value=".$value['catid'].">".$value['catname']."</option>";
    	}
    	echo $str;
    }
    /**
     * 获取产品第三级分类
     */
    public function getgoodscatschildtwo()
    {   
    	$str = "<option value=''>请选择</option>";
    	$catid = I('post.catid');
    	$GoodscatsModel = new GoodscatsModel();
    	$info = $GoodscatsModel->modelgetchildinfobycatid($catid);
    	foreach ($info as $key => $value) {
    		$str = $str."<option  value=".$value['catid'].">".$value['catname']."</option>";
    	}
    	echo $str;
    }
    
      /**
     * 添加产品操作
     */
    public function doAddProduct()
    {   
//        $offername = $_POST['offername'];
//        $OffersModel = new OffersModel();
//        $info = $OffersModel->modelgetinfobyloginname($offername);
//        if(empty($info))
//        {
//             $this->error('供应商信息有误！');
//        }
        $offerid = $this->_data['offerid'];
        $isSpec = $_POST['isSpec'];
        $_POST['offerid'] = $offerid;
        $GoodsModel = new GoodsModel();
        $goodsid = $GoodsModel->modelAddGoods();
        if($goodsid >=1 && $isSpec == 1)
        {   
            $speca = $_POST['speca'];
            for($i=0;$i<count($speca);$i++)
            {
               $data['speca'] = $_POST['speca'][$i];
               $data['specb'] = $_POST['specb'][$i];
               $data['offerPrice'] = $_POST['offerPrice'][$i];
               $data['specnum'] = $_POST['specnum'][$i];
               $data['specdesc'] = $_POST['specdesc'][$i];
               $data['speccode'] = $_POST['code'][$i];
               $data['specweight'] = $_POST['weight'][$i];
               $data['goodsid'] = $goodsid;
               $GoodsspecsModel = new GoodsspecsModel();
               $GoodsspecsModel->modelAddGoodsspecs($data);
            }
            $this->success("产品添加操作成功！");
        }
        else
        {
            $this->error($goodsid);
        }
    }
     /**
     * 修改产品操作
     */
    public function doEditProduct()
    {   
//        $offername = $_POST['offername'];
//        $OffersModel = new OffersModel();
//        $info = $OffersModel->modelgetinfobyloginname($offername);
        $offerid = $this->_data['offerid'];
        $isSpec = $_POST['isSpec'];
        $_POST['offerid'] = $offerid;
        $GoodsModel = new GoodsModel();
        $goodsid = $_POST['id'];
        $res = $GoodsModel->modelEditGoods();
        if($res==1 && $isSpec == 1)
        {   
            $GoodsspecsModel = new GoodsspecsModel();
            $GoodsspecsModel->modeldeleteinfo($goodsid);
            $speca = $_POST['speca'];
            for($i=0;$i<count($speca);$i++)
            {
               $data['speca'] = $_POST['speca'][$i];
               $data['specb'] = $_POST['specb'][$i];
               $data['offerPrice'] = $_POST['offerPrice'][$i];
               $data['specnum'] = $_POST['specnum'][$i];
               $data['specdesc'] = $_POST['specdesc'][$i];
               $data['speccode'] = $_POST['code'][$i];
               $data['specweight'] = $_POST['weight'][$i];
               $data['goodsid'] = $goodsid;
               $GoodsspecsModel = new GoodsspecsModel();
               $GoodsspecsModel->modelAddGoodsspecs($data);
            }
            $this->success("产品修改操作成功！");
        }
        else
        {
            $this->error("产品修改操作失败！");
        }
    }
    /**
     * 修改产品页面
     */
    public function editproductpage()
    {   
        $id = I('get.id');
        $GoodsModel = new GoodsModel();
        $GoodsspecsModel =  new GoodsspecsModel();
        $BrandsModel = new BrandsModel();
        $OffersModel = new OffersModel();
        $GoodscatsModel = new GoodscatsModel();
        $brandslist = $BrandsModel->modelgetbrandallinfo();
        $goodscatslist = $GoodscatsModel->modelgetleveloneinfo();
        $info = $GoodsModel->modelgetinfobyid($id);
        $goodsid = $info['id'];
        $offerid = $info['offerid'];
        $goodsCatIdfirst = $info['goodscatidfirst'];
        $goodsCatIdmiddle = $info['goodscatidmiddle'];
        $offersinfo = $OffersModel->modelgetinfobyid($offerid);
        $goodsspecs = $GoodsspecsModel->modelgetinfobyid($goodsid);
        $goodscatsmiddlelist = $GoodscatsModel->modelgetchildinfobycatid($goodsCatIdfirst);
        $goodscatslastlist = $GoodscatsModel->modelgetchildinfobycatid($goodsCatIdmiddle);
        $this->assign("goodscatsmiddlelist",$goodscatsmiddlelist);
        $this->assign("goodscatslastlist",$goodscatslastlist);
        $this->assign('goodsspecs',$goodsspecs);
        $this->assign("brandslist",$brandslist);
        $this->assign("goodscatslist",$goodscatslist);
        $this->assign("goodstemplatelist",$goodstemplatelist);
        $this->assign("offersinfo",$offersinfo);
        $this->assign("info",$info);
        $this->assign("data",$this->_data);
        $this->display();
    }
     /**
     * 删除产品
     */
    public function delete()
    {
        $data['id'] = I('get.id');
        $data['dataFlag'] = 1;
        $GoodsModel = new GoodsModel();
        $res = $GoodsModel->modeldelete($data);
        if($res)
        {
            $this->success("删除产品操作成功！");
        }
        else
        {
            $this->error("删除产品操作失败！");
        }
    }
    
     /**
     * 下架产品
     */
    public function downproduct()
    {
        $data['id'] = I('get.id');
        $data['status'] = self::DOWNSTATUS;
        $GoodsModel = new GoodsModel();
        $res = $GoodsModel->modelupdown($data);
        if($res)
        {
            $this->success("下架产品操作成功！");
        }
        else
        {
            $this->error("下架产品操作失败！");
        }
    }
    //提交商品审核
    public function submitcheck()
    {   
        if($_GET)
        {
             $data['id'] = I('get.id');
             $data['status'] = self::STATUS;
             $GoodsModel = new GoodsModel();
             $res = $GoodsModel->modelsubmitcheck($data);
             if($res)
             {
                $this->success("提交审核操作成功！");
             }
             else
             {
                $this->error("提交审核操作失败！");
             }
        
        
        }
        
    }

}