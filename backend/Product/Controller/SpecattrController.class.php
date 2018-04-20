<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Product\Controller;
use Common\Controllers\BaseController;
use Product\Model\SpecattrkeyModel;
use Product\Model\SpectemplateModel;
class SpecattrController extends BaseController{
    //获取规格名称信息
    public function index()
    {
        $this->display();
    }
    //添加规格标签
    public function addspecattr()
    {   
        $Spectemplate = new SpectemplateModel;
        $templateinfo = $Spectemplate->modelgetAlltemplate();
        $this->assign("templateinfo",$templateinfo);
        $this->display();
    }
    //添加规格标签操作
    public function doaddspecattr()
    {
        $SpecattrkeyModel = new SpecattrkeyModel;
        $res = $SpecattrkeyModel->modelAddSpecattr();
        if($res == 1)
        {
            $this->success('添加规格标签成功！');
        }
        else
        {
            $this->error($res);
        }
    }
}