<?php
namespace Product\Controller;
use \Common\Controllers\BaseController;
use Product\Model\GoodscatsModel;
use Product\Model\GoodsModel;
use Product\Model\BrandsModel;
use Product\Model\GoodsspecsModel;
use Offers\Model\OffersModel;
use Ship\Model\GoodstemplateModel;
use Product\Model\SpectemplateModel;
use Product\Model\SpecattrkeyModel;
use Product\Model\SpecattrvalModel;
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
     *添加产品页面
     */
    public function addproductpage()
    {   
    	$GoodscatsModel = new GoodscatsModel();
    	$BrandsModel = new BrandsModel();
        $GoodstemplateModel = new GoodstemplateModel();
    	$goodscatslist = $GoodscatsModel->modelgetleveloneinfo();
    	$brandslist = $BrandsModel->modelgetbrandallinfo();
        $goodstemplatelist = $GoodstemplateModel->modelgettemplateinfo();
        $Spectemplate = new SpectemplateModel;
        $templateinfo = $Spectemplate->modelgetAlltemplate();
        $this->assign("templateinfo",$templateinfo);
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
    
    //获取规格标签信息
    public function getattrvalinfo()
    { 
        $SpecattrkeyModel = new SpecattrkeyModel;
        $SpecattrkvalModel = new SpecattrvalModel;
        $item_id = I('post.item_id');
        $attrinfo = $SpecattrkeyModel->modelgetinfobyitemid($item_id);
        $attrvalinfo = $SpecattrkvalModel->modelgetvalinfobyitemid($item_id);
        $arr1 = [];
        $arr2 = [];
        
//        print_r($attrinfo);
//        exit;
     
        foreach ($attrinfo as $key => $value) {
                $str[1] = '';
                $attr_key_id = $value['attr_key_id'];
                $SpecattrkvalModel = new SpecattrvalModel;
                $SpecattrvalInfo = $SpecattrkvalModel->modelgetvalinfobyitemvalid($attr_key_id);
                foreach ($SpecattrvalInfo as $k => $v) {
                   $str[$key] = $str[$key]."&nbsp;&nbsp;&nbsp;<input type='checkbox' /><input value=".$v['attr_value']." type='text'>";
                }
                $arr1[] = "<div><label>".$value['name']."</label>".$str[$key]."<div><br>";
        }
//        foreach ($attrvalinfo as $key => $value) {
//                
//        }
//    	$response['str'] = $arr[1]."<br>".$arr2[1];
        $response['str1'] = $arr1;
        die(json_encode($response));
        
    }
    
    
    /**
     * 添加产品操作
     */
    public function doAddProduct()
    {   
        $offername = $_POST['offername'];
        $OffersModel = new OffersModel();
        $info = $OffersModel->modelgetinfobyloginname($offername);
        if(empty($info))
        {
             $this->error('供应商信息有误！');
        }
        $offerid = $info['offerid'];
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
               $data['specPrice'] = $_POST['specPrice'][$i];
               $data['speccode'] = $_POST['code'][$i];
               $data['specweight'] = $_POST['weight'][$i];
               $data['specnum'] = $_POST['specnum'][$i];
               $data['specdesc'] = $_POST['specdesc'][$i];
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
        $offername = $_POST['offername'];
        $OffersModel = new OffersModel();
        $info = $OffersModel->modelgetinfobyloginname($offername);
        $offerid = $info['offerid'];
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
               $data['specPrice'] = $_POST['specPrice'][$i];
               $data['offerPrice'] = $_POST['offerPrice'][$i];
               $data['specnum'] = $_POST['specnum'][$i];
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
        $GoodstemplateModel = new GoodstemplateModel();
        $OffersModel = new OffersModel();
        $GoodscatsModel = new GoodscatsModel();
        $brandslist = $BrandsModel->modelgetbrandallinfo();
        $goodscatslist = $GoodscatsModel->modelgetleveloneinfo();
        $goodstemplatelist = $GoodstemplateModel->modelgettemplateinfo();
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
     * 审核通过
     */
    public function checkacross()
    {
        $data['id'] = I('get.id');
        $data['status'] = self::CHECKACROSS;
        $GoodsModel = new GoodsModel();
        $res = $GoodsModel->modelcheck($data);
        if($res)
        {
            $this->success("产品通过审核操作成功！");
        }
        else
        {
            $this->error("产品通过审核操作失败！");
        }

    }
    /**
     * 审核失败
     */
    public function checkfail()
    {
        $data['id'] = I('get.id');
        $data['status'] = self::CHECKFAIL;
        $GoodsModel = new GoodsModel();
        $res = $GoodsModel->modelcheck($data);
        if($res)
        {
            $this->success("产品未通过审核操作成功！");
        }
        else
        {
            $this->error("产品未通过审核操作失败！");
        }
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
     * 上架产品
     */
    public function upproduct()
    {
        $data['id'] = I('get.id');
        $data['status'] = self::UPSTATUS;
        $GoodsModel = new GoodsModel();
        $res = $GoodsModel->modelupdown($data);
        if($res)
        {
            $this->success("上架产品操作成功！");
        }
        else
        {
            $this->error("上架产品操作失败！");
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
    /**
     * 供货商信息是否正确
     */
    public function check_offers()
    {
        $offerloginName = I('post.offerloginName');
        $Offers = M('offers');
        $OffersInfoCount = $Offers->where(['loginName'=>$offerloginName])->count();
        if($OffersInfoCount != 1 )
        {
            $response['code'] = '000000';
            $response['msg'] = '不存在此供货商！';
            die(json_encode($response));
        }
    }
}