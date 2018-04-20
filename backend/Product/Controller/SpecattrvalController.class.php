<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Product\Controller;
use Common\Controllers\BaseController;
use Product\Model\SpecattrkeyModel;
use Product\Model\SpecattrvalModel;
use Product\Model\SpectemplateModel;
class SpecattrvalController extends BaseController{
    //获取规格值信息
    public function index()
    {
        $this->display();
    }
    //添加规格值
    public function addspecattrval()
    {   
        $Spectemplate = new SpectemplateModel;
        $templateinfo = $Spectemplate->modelgetAlltemplate();
        $this->assign("templateinfo",$templateinfo);
        $this->display();
    }
    //添加规格值操作
    public function doaddspecattrval()
    {
        $SpecattrvalModel = new SpecattrvalModel;
        $res = $SpecattrvalModel->modelAddSpecattrval();
        if($res == 1)
        {
            $this->success('添加规格值成功！');
        }
        else
        {
            $this->error($res);
        }
    }
    //获取规格标签信息
    public function getattrvalinfo()
    { 
        $SpecattrkeyModel = new SpecattrkeyModel;
        $item_id = I('post.item_id');
        $attrinfo = $SpecattrkeyModel->modelgetinfobyitemid($item_id);
        foreach ($attrinfo as $key => $value) {
    		$str = $str."<option  value=".$value['attr_key_id'].">".$value['name']."</option>";
    	}
    	echo $str;
    }
}