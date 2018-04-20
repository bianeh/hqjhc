<?php 
namespace Offers\Controller;
use \Common\Controllers\BaseController;
use Offers\Model\OffersModel;
class IndexController extends BaseController{
    public function index(){
        $this->display();
    }
}
?>