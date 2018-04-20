<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Common\Controllers;
use \Think\Controller;
class CategoryController{
    
     public function index($list,$pid=0,$level=1,$html="|-")
    {    
          static $treearticle = array();
          foreach ($list as $key=>$val) {
            if($val['parentid'] == $pid)
            {
                $val['html'] = str_repeat($html,$level)."||-";
                $treearticle[] = $val;
                $this->index($list,$val['catid'],$level+1);
            }
          }
          return $treearticle;

    }
}
