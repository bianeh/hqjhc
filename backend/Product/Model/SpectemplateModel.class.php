<?php
namespace Product\Model;
use Think\Model;
class SpectemplateModel extends Model{
    CONST DATAFLAG = 0;
    public $tableName = "spec_template";
    public function __construct() {
        parent::__construct();
    }
    protected $_validate = array(
     array('name','require','规格模板名称不能为空！'),
    );
    protected $_auto = array ( 
         array('createTime','mydate','1','callback'),
     );
    protected function mydate()
    {
        return date("Y-m-d H:i:s");
    }
    /**
     * 添加规格模板
     */
   public function modelAddSpectemplate()
    {   
        $Spec_template = D('spec_template');
        if(!$Spec_template->create())
        {
            return $Spec_template->getError();
        }
        else 
        {
            $Spec_template->add();
            return 1;
        }
    }
    /**
     * 获取所有的规格模板
     */
    public function modelgetAlltemplate()
    {
        $Spec_template = D('spec_template');
        return $Spec_template->where(['dataFlag'=>0])->select();
    }
}
