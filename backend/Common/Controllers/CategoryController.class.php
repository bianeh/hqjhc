<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Common\Controllers;
use \Think\Controller;
class CategoryController{
     public function index($list,$pid=0,$level=1,$html="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")
    {    
          static $treearticle = array();
          foreach ($list as $key=>$val) {
            if($val['parentid'] == $pid)
            {
                $val['nbsp'] = str_repeat($html,$level)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
                $val['html'] =$val['nbsp']."<i class='fa fa-fw fa-folder-o'></i>";
                $treearticle[] = $val;
                $this->index($list,$val['catid'],$level+1,$html="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp");
            }
          }
          return $treearticle;
    }
}
