<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class QueryexpressController extends Controller{
    //查询快递信息
    public function queryexpress()
    {   
        $expressname = I('get.expressname');
        $expressno = I('get.expressno');
        $this->assign('expressname',$expressname);
        $this->assign('expressno',$expressno);
        $this->display();
    }
}
