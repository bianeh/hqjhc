<?php
namespace Layout\Controller;
use Common\Controllers\BaseController;
class IndexController extends BaseController {
    public function header(){
        $this->display();
    }
    public function nav(){
        $this->display();
    }
    public function footer()
    {   
        $this->display();
    }
}