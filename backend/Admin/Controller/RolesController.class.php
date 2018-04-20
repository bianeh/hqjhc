<?php
namespace Admin\Controller;
use Think\Controller;
class RolesController extends Controller {
    CONST DATAFLAG = 0;
   /**
    * 部门信息列表
    */
    public function index()
    {    
        $Data = M('roles');
        $count      = $Data->count();  
        $Page = $Page = new \Think\Page($count, 10);
        $show       = $Page->show();
        $orderby['roleid']='desc';
        $list = $Data->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    /**
     * 添加部门页面
     */
    public function addRolesPage()
    {   

        $Privileges = D('privileges');
        $infoone = $Privileges->where(['menuid'=>1,'dataFlag'=>self::DATAFLAG,'isMenuPrivilege'=>0])->select();
        $infotwo = $Privileges->where(['menuid'=>2,'dataFlag'=>self::DATAFLAG,'isMenuPrivilege'=>0])->select();
        $infothree = $Privileges->where(['menuid'=>3,'dataFlag'=>self::DATAFLAG,'isMenuPrivilege'=>0])->select();
        $infofour = $Privileges->where(['menuid'=>4,'dataFlag'=>self::DATAFLAG,'isMenuPrivilege'=>0])->select();
        $infofive = $Privileges->where(['menuid'=>5,'dataFlag'=>self::DATAFLAG,'isMenuPrivilege'=>0])->select();
        $infosix = $Privileges->where(['menuid'=>6,'dataFlag'=>self::DATAFLAG,'isMenuPrivilege'=>0])->select();
        $infoseven = $Privileges->where(['menuid'=>7,'dataFlag'=>self::DATAFLAG,'isMenuPrivilege'=>0])->select();
        $infoeight = $Privileges->where(['menuid'=>8,'dataFlag'=>self::DATAFLAG,'isMenuPrivilege'=>0])->select();
        $infonine = $Privileges->where(['menuid'=>9,'dataFlag'=>self::DATAFLAG,'isMenuPrivilege'=>0])->select();
        $infoten = $Privileges->where(['menuid'=>10,'dataFlag'=>self::DATAFLAG,'isMenuPrivilege'=>0])->select();
        $infoeleven = $Privileges->where(['menuid'=>11,'dataFlag'=>self::DATAFLAG,'isMenuPrivilege'=>0])->select();
        $infotwf = $Privileges->where(['menuid'=>12,'dataFlag'=>self::DATAFLAG,'isMenuPrivilege'=>0])->select();
        $infothr = $Privileges->where(['menuid'=>13,'dataFlag'=>self::DATAFLAG,'isMenuPrivilege'=>0])->select();

        $this->assign('infoone',$infoone);
        $this->assign('infotwo',$infotwo);
        $this->assign('infothree',$infothree);
        $this->assign('infofour',$infofour);
        $this->assign('infofive',$infofive);
        $this->assign('infosix',$infosix);
        $this->assign('infoseven',$infoseven);
        $this->assign('infoeight',$infoeight);
        $this->assign('infonine',$infonine);
        $this->assign('infoten',$infoten);
        $this->assign('infoelevn',$infoelevn);
        $this->assign('infotwf',$infotwf);
        $this->assign('infothr',$infothr);
        $this->display();
    }
    
}