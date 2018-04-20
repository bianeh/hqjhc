<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Product\Controller;
use Common\Controllers\BaseController;
use Product\Model\SpectemplateModel;
class SpectemplateController extends BaseController{
    //规格模板信息
    public function index()
    {
        $this->display();
    }
    //添加规格模板信息
    public function addspectemplate()
    {
        $this->display();
    }
    //添加规格模板操作
    public function doaddspectemplate()
    {
        $SpectemplateModel = new SpectemplateModel;
        $res = $SpectemplateModel->modelAddSpectemplate();
        if($res == 1)
        {
            $this->success('添加规格模板成功！');
        }
        else
        {
            $this->error($res);
        }
    }
}

