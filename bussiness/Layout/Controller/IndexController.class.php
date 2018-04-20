<?php
namespace Layout\Controller;
use Think\Controller;
class IndexController extends Controller {
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