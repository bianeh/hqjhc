<?php
namespace Ship\controller;
use \Common\Controllers\BaseController;  
    class ShippingController extends BaseController
    { 
        public function index()
        {
            $template=M('goods_template');
            
            $temp['status']=1;
            $params = "";
            //商品名称
            $template_name = $_POST['template_name'];
            if( !empty($template_name) ) {
                $temp['template_name'] = array('like','%'.$template_name.'%');
                $params .= "&template_name=" . $template_name;
                $this->assign("template_name",$template_name);
            }
            //计费方式
            $price_way = $_POST['price_way'];
            if( !empty($price_way) ) {
                $temp['price_way'] = $price_way;
                $params .= "&price_way=" . $price_way;
                $this->assign("price_way",$price_way);
            }
            
            //开始添加时间
            $start_add_time = $_POST['start_add_time'];
            if( !empty($start_add_time) ) {
                $formated_start_add_time = strtotime($start_add_time);
                $temp['create_time']= array('GT', $formated_start_add_time);
                $params .= "&start_add_time=" . $start_add_time;
                $this->assign("start_add_time",$start_add_time);
            }
            
            //结束添加时间
            $end_add_time = $_POST['end_add_time'];
            if( !empty($end_add_time) ) {
                $formated_end_add_time = strtotime($end_add_time);
                $temp['create_time']= array('LT', $formated_start_add_time);
                $params .= "&end_add_time=" . $end_add_time;
                $this->assign("end_add_time",$end_add_time);
            }
            
            //查找总数
            $count = $template_list=$template->where($temp)->count();
            //分页
            $Page       = new \Think\Page($count,10);
            $show = $Page->show(true);
            
            
            $template_list=$template->where($temp)->limit($Page->firstRow.','.$Page->listRows)->order("price_way")->select();
            $i=1;
            $way=M("shipping_way");
            foreach ($template_list as &$template){
                $template['country']=$this->get_region_name($template[country]);
                $template['province']=$this->get_region_name($template[province]);
                $template['city']=$this->get_region_name($template[city]);
                $template['district']=$this->get_region_name($template['district']);
                $way_list=$way->where("template_id=$template[template_id] and is_default=1")->find();
                $template['default']=$way_list;
                $i++;
            }
            $this->assign("template_list",$template_list);
            $this->assign("page",$show);
            $this->display();
        }
        /* 获得地区名称 */
        public function get_region_name($region_id){
            return M("area")->where("region_id=$region_id")->getField("region_name");
        }
        /**
         * 添加模板信息
         */
        public function add()
        {
            if ($_POST) {
                
                $shipping_way=M("shipping_way");
                
                if(trim($_POST['template_name'])==''){
                    $this->error('请填写模板名称！');die;
                }
                if(trim($_POST['country'])==0||trim($_POST['province'])==0||trim($_POST['city'])==0||trim($_POST['area'])==0){
                    $this->error('请选择商品所在地区！');die;
                }
                foreach ($_POST['default'] as &$default){
                    $default_first_num=trim($default['first_num']);
                    $default_first_fee=trim($default['first_fee']);
                    $default_continue_num=trim($default['continue_num']);
                    $default_continue_fee=trim($default['continue_fee']);
                    if($default_first_num==0||$default_first_num==''||!is_numeric($default_first_num)){
                        $this->error('商品件数必须为大于0的数字');die;
                    }
                    if($default_first_fee==0||$default_first_fee==''||!is_numeric($default_first_fee)){
                        $this->error('商品首费价格必须为大于0的数字');die;
                    }
                    if($default_continue_num==0||$default_continue_num==''||!is_numeric($default_continue_num)){
                        $this->error('商品续件数必须为大于0的数字');die;
                    }
                    if($default_continue_fee==0||$default_continue_fee==''||!is_numeric($default_continue_fee)){
                        $this->error('商品续费价格必须为大于0的数字');die;
                    }
                        $default[area_name]="全国";
                        $default[area_id]=1;
                        $default[is_default]=1;
                        $default[create_date]=time();
                        $default[create_by]=session('uid');
                }
                foreach ($_POST['other'] as &$others){
                    if($others[area_id]==0||$others[area_id]==''){
                        $this->error('请选择商品配送区域');die;
                    }
                    if($others[first_num]==0||$others[first_num]==''||!is_numeric($others[first_num])){
                        $this->error('商品首费价格必须为大于0的数字');die;
                    }
                    if($others[first_fee]==0||$others[first_fee]==''||!is_numeric($others[first_fee])){
                        $this->error('商品首费价格必须为大于0的数字');die;
                    }
                    if($others[continue_num]==0||$others[continue_num]==''||!is_numeric($others[continue_num])){
                        $this->error('商品续件数必须为大于0的数字');die;
                    } 
                    if($others[continue_fee]==0||$others[continue_fee]==''||!is_numeric($others[continue_fee])){
                        $this->error('商品续费价格必须为大于0的数字');die;
                    } 
                    $others[is_default]=0;
                    $others[create_date]=time();
                    $others[create_by]=session('uid');
                    
                }              
                
                
                $data['country']=trim($_POST['country']);
                $data['province']=trim($_POST['province']);
                $data['city']=trim($_POST['city']);
                $data['district']=trim($_POST['area']);
                $data['is_free']=trim($_POST['is_free']);
                $data['price_way']=trim($_POST['price_way']);
                $data['shipping_way']=implode(',',$_POST['shipping_way']);
                
                $data['goods_id']=!empty($_POST['goods_id']) ? intval($_POST['goods_id']) : 0;
                $data['shop_id']=!empty($_POST['shop_id']) ? intval($_POST['shop_id']) : 0;
                $data['template_name']=$_POST['template_name'];
                $data['status']=1;
                $data['create_date']=time();
                $data['create_by']=session('uid');
                $template = M('goods_template');
                $way_id=$template->add($data);
                if($way_id){
                    
                    foreach ($_POST['default'] as &$default){
                        $default[template_id]=$way_id;
                        $default_res=$shipping_way->add($default);
                    }
                    foreach ($_POST['other'] as &$other){
                        $other[template_id]=$way_id;
                        $other_res=$shipping_way->add($other);
                    }
                    //$default_res=$shipping_way->addAll($_POST['default']);
                    //$other_res=$shipping_way->addAll($_POST['other']);
                    if(!$default_res&&!$other_res){
                        $this->error(' 运送方式添加失败',U('add'));
                    }else{
                        $this->success('操作成功',U('index'));
                    }
                }else{
                    $this->error('添加失败',U('add'));
                }
                
            }else{
                /* 绑定店铺或商品id */
                $region=M("area");
                $this->assign("shop_id",trim($_GET['shop_id']));
                
                //国家列表
                $countrylist=$region->where(array('region_type'=>0))->select();
                $this->assign('countrylist',$countrylist);
                
                $this->display('template_add');
            }
        }
        public function info(){
            if($_GET['template_id']){
                $template_id=I("get.template_id");
                $shipping_way=M("shipping_way");
                $template = M('goods_template');
                $template_row=$template->where("template_id=$template_id")->find();
                $this->assign("template_row",$template_row);
                $way_list=$shipping_way->where("template_id=$template_id")->order("shipping_way")->select();
                $this->assign("way_list",$way_list);
                $this->display();
            }
        }

//         /**
//          * 修改模板信息
//          */
//         public function edit()
//         {
//             if ($_POST['template_id']) {
//                 $shipping_way=M("shipping_way");
//                 if(trim($_POST['template_name'])==''){
//                     $this->error('请填写模板名称！');die;
//                 }
//                 if(trim($_POST['country'])==0||trim($_POST['province'])==0||trim($_POST['city'])==0||trim($_POST['area'])==0){
//                     $this->error('请选择商品所在地区！');die;
//                 }
//                 foreach ($_POST['default'] as &$default){
//                     $default_first_num=trim($default['first_num']);
//                     $default_first_fee=trim($default['first_fee']);
//                     $default_continue_num=trim($default['continue_num']);
//                     $default_continue_fee=trim($default['continue_fee']);
//                     if($default_first_num==0||$default_first_num==''||!is_numeric($default_first_num)){
//                         $this->error('商品件数必须为大于0的数字');die;
//                     }
//                     if($default_first_fee==0||$default_first_fee==''||!is_numeric($default_first_fee)){
//                         $this->error('商品首费价格必须为大于0的数字');die;
//                     }
//                     if($default_continue_num==0||$default_continue_num==''||!is_numeric($default_continue_num)){
//                         $this->error('商品续件数必须为大于0的数字');die;
//                     }
//                     if($default_continue_fee==0||$default_continue_fee==''||!is_numeric($default_continue_fee)){
//                         $this->error('商品续费价格必须为大于0的数字');die;
//                     }
//                         $default[area_name]="全国";
//                         $default[area_id]=1;
//                         $default[is_default]=1;
//                         $default[update_date]=time();
//                         $default[create_by]=session('uid');
//                 }
//                 foreach ($_POST['other'] as &$others){
//                     if($others[area_id]==0||$others[area_id]==''){
//                         $this->error('请选择商品配送区域');die;
//                     }
//                     if($others[first_num]==0||$others[first_num]==''||!is_numeric($others[first_num])){
//                         $this->error('商品首费价格必须为大于0的数字');die;
//                     }
//                     if($others[first_fee]==0||$others[first_fee]==''||!is_numeric($others[first_fee])){
//                         $this->error('商品首费价格必须为大于0的数字');die;
//                     }
//                     if($others[continue_num]==0||$others[continue_num]==''||!is_numeric($others[continue_num])){
//                         $this->error('商品续件数必须为大于0的数字');die;
//                     } 
//                     if($others[continue_fee]==0||$others[continue_fee]==''||!is_numeric($others[continue_fee])){
//                         $this->error('商品续费价格必须为大于0的数字');die;
//                     } 
//                     $others[is_default]=0;
//                     $others[update_date]=time();
//                     $others[create_by]=session('uid');
//                 }              
                
//                 $data['country']=trim($_POST['country']);
//                 $data['province']=trim($_POST['province']);
//                 $data['city']=trim($_POST['city']);
//                 $data['district']=trim($_POST['area']);
//                 $data['is_free']=trim($_POST['is_free']);
//                 $data['price_way']=trim($_POST['price_way']);
//                 $data['shipping_way']=implode(',',$_POST['shipping_way']);
                
//                 $data['goods_id']=!empty($_POST['goods_id']) ? intval($_POST['goods_id']) : 0;
//                 $data['shop_id']=!empty($_POST['shop_id']) ? intval($_POST['shop_id']) : 0;
//                 $data['template_name']=$_POST['template_name'];
//                 $data['status']=1;
//                 $data['update_date']=time();
//                 $data['create_by']=session('uid');
//                 $template = M('goods_shipping_template');
//                 $way_save=$template->where("template_id=$_POST[template_id]")->save($data);
//                 if($way_save){
//                     //删除原有记录
//                     $del_res=$shipping_way->where("template_id=$_POST[template_id]")->delete();
//                     foreach ($_POST['default'] as &$default){
//                         $default[template_id]=$_POST[template_id];
//                         $default_res=$shipping_way->add($default);
//                     }
//                     foreach ($_POST['other'] as &$other){
//                         $other[template_id]=$_POST[template_id];
//                         $other_res=$shipping_way->add($other);
//                     }
//                     //$default_res=$shipping_way->addAll($_POST['default']);
//                     //$other_res=$shipping_way->addAll($_POST['other']);
//                     if(!$default_res&&!$other_res){
//                         $this->error(' 运送方式添加失败',U('add'));
//                     }else{
//                         $this->success('操作成功',U('index'));
//                     }
//                 }else{
//                     $this->error('添加失败',U('add'));
//                 }   
//             }else{
//                 /* 绑定店铺或商品id */
//                 $region=M("region");
//                 $template_id=$_GET['template_id'];
//                 $this->assign("shop_id",trim($_GET['shop_id']));
//                 $this->assign("template_id",trim($_GET['template_id']));
//                 if(!empty($template_id)&&is_numeric($template_id)){
//                     $where="template_id=$template_id and status=1";
                
//                     $template = M('goods_shipping_template');
//                     $way = M('shipping_way');
//                     $template_list=$template->where($where)->find();
//                     $this->assign("template_list",$template_list);
//                     /* 三种运送方式默认数据 */
//                     $way_default=$way->where("template_id=$template_id and is_default=1")->select();
//                     $this->assign("way_default",$way_default);
//                     /* 三种运送方式 指定地区数据*/
//                     $way_other=$way->where("template_id=$template_id and is_default=0")->select();
//                     $this->assign("way_other",$way_other);

//                     $template_list['default_size']=sizeof($way_default);
//                     $template_list['other_size']=sizeof($way_other);
//                     $template_list['all_size']=$template_list['default_size']+$template_list['other_size'];
                    
//                     $this->assign('template_list',$template_list);
                
//                     $this->assign("shop_id",trim($_GET['shop_id']));
                
//                     //省、市、区选中查询
//                     $provincelist=$region->where(array('parent_id'=>$template_list[country]))->select();
//                     $citylist=$region->where(array('parent_id'=>$template_list[province]))->select();
//                     $districtlist=$region->where(array('parent_id'=>$template_list[city]))->select();
//                     $this->assign("provincelist",$provincelist);
//                     $this->assign("citylist",$citylist);
//                     $this->assign("districtlist",$districtlist);
//                 }
                
//                 //国家列表
//                 $countrylist=$region->where(array('region_type'=>0))->select();
//                 $this->assign('countrylist',$countrylist);
                
//                 $this->display("template_edit");
//             }
            
            
//         }       
               
        /**
         * 根据商品id获取运费
         */
        public function getFreight()
        {
            $goods_id    = isset($_REQUEST['goods_id']) ? intval($_REQUEST['goods_id']) : '';
            $province_id = isset($_REQUEST['province_id']) ? intval($_REQUEST['province_id']) : 0;
            $goods_num   = isset($_REQUEST['goods_num']) ? intval($_REQUEST['goods_num']) : 1;
            //$shop_id = isset($_REQUEST['shop_id']) ? intval($_REQUEST['shop_id']) : '';
            if (empty($goods_id)) die('商品id不能为空');
            $where    = array(
                'goods_id' => $goods_id,
                'shop_id'  => 0,
                'status'   => 1,
            );
            $shipping = M('goods_template')->where($where)->find();
            if (empty($shipping)) die('该商品没有设置运费');
            $defaule = json_decode($shipping['default'], true);
            //判断有没设置地区
            if (empty($shipping['other'])) {
                //没有设置地区，在默认件数内
                if ($goods_num <= $defaule['default_num']) {
                    $fee = array(
                        'goods_id'    => $goods_id,
                        'goods_num'   => $goods_num,
                        'province_id' => $province_id,
                        'shippin_fee' => $defaule['default_fee'],
                    );
                } else {
                    //不在默认件数内,每增加n件商品增加运费n元
                    $increase = floor(($goods_num - $defaule['default_num']) / $defaule['other_num']) * $defaule['other_fee'];
                    $fee      = array(
                        'goods_id'    => $goods_id,
                        'goods_num'   => $goods_num,
                        'province_id' => $province_id,
                        'shippin_fee' => $defaule['default_fee'] + $increase,
                    );
                }
            } else {
                //设置了地区
                $other = json_decode($shipping['other'], true);
                foreach ($other as $key => $value) {
                    //给定的省份在设置的地区中
                    $_key = explode(',', $key);
                    if (in_array($province_id, $_key)) {
                        //在默认件数内
                        if ($goods_num <= $value['default_num']) {
                            $fee = array(
                                'goods_id'    => $goods_id,
                                'goods_num'   => $goods_num,
                                'province_id' => $province_id,
                                'shippin_fee' => $value['default_fee'],
                            );
                        } else {
                            //不在默认件数内,每增加n件商品增加运费n元
                            $increase = floor(($goods_num - $value['default_num']) / $value['other_num']) * $value['other_fee'];
                            $fee      = array(
                                'goods_id'    => $goods_id,
                                'goods_num'   => $goods_num,
                                'province_id' => $province_id,
                                'shippin_fee' => $value['default_fee'] + $increase,
                            );
                        }
                    } else {
                        if ($goods_num <= $defaule['default_num']) {
                            $fee = array(
                                'goods_id'    => $goods_id,
                                'goods_num'   => $goods_num,
                                'province_id' => $province_id,
                                'shippin_fee' => $defaule['default_fee'],
                            );
                        } else {
                            //不在默认件数内,每增加n件商品增加运费n元
                            $increase = floor(($goods_num - $defaule['default_num']) / $defaule['other_num']) * $defaule['other_fee'];
                            $fee      = array(
                                'goods_id'    => $goods_id,
                                'goods_num'   => $goods_num,
                                'province_id' => $province_id,
                                'shippin_fee' => $defaule['default_fee'] + $increase,
                            );
                        }
                    }
                }
            }
            dump($fee);
        }
        
        /**
         * ajax获取区域列表
         */
        public function getArea()
        {
            $data = M('larger_area')->select();
            foreach ($data as $k => $v) {
                $data[$k]['arr_child']      = explode(',', $v['arr_child']);
                $data[$k]['arr_child_name'] = explode(',', $v['arr_child_name']);
            }
            echo json_encode($data);
        }
        /* 获取下来列表 */
        public function get_city(){
            $region=M("area");
            $id=$_GET["parent"];
            $city_list=$region->where("parent_id=$id")->select();
            $this->ajaxReturn($city_list);
        }
        /* 删除操作 20160913 jinbanglong*/
        public function delete(){
            if(!empty($_GET[template_id])&&is_numeric($_GET[template_id])){
                $template=M('goods_template');
                $data[status]=0;
                $data[update_date]=time();
                $res=$template->where("template_id=$_GET[template_id]")->save($data);
            }
            if($res){
                $this->success('操作成功',U('Shipping/index'));
            }else{
                $this->error('操作失败');
            }
            
        }
        
    }