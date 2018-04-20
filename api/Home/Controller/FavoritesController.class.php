<?php
namespace Home\Controller;
use Think\Controller;
class FavoritesController extends Controller{
        CONST DATAFLAG = 0;
	/**
	 * 关注商品列表
	 */
	public function index()
	{
            $username = I('post.loginName');
            if(!$username)
            {
                 $response['code'] = '000006';
                 $response['msg'] = '请输入登录名！';
                 die(json_encode($response));
            }
            $res = $this->checkUser($username);
            if(count($res) != 1)
            {
                    $response['code'] = '000001';
                    $response['msg'] = '没有此用户！';
                    $response['favoritesinfo'] = '';
            }else
            {
                $UserInfo = $this->getUserInfo($username);
                $userid = $UserInfo['userid'];
                $FavoritesInfo = $this->getUserFavoritesInfo($userid);
                $response['code'] = '000008';
                $response['msg'] = '成功获取数据信息';
                $response['favoritesinfo'] = $FavoritesInfo;
            }
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        die(json_encode($response));
	}
	/**
	 * 用户关注商品接口API
	 * @return [type] [description]
	 */
	public function doFavorite()
	{
        $targetid = I('post.productid');
        $username = I('post.loginName');
        if(!$targetid)
        {
            $response['code'] = '000001';
            $response['msg'] = '产品id不能为空！';
        }
        if(!$username)
        {
            $response['code'] = '000001';
            $response['msg'] = '用户名不能为空！';
        }
        $res = $this->checkUser($username);
        if(count($res) != 1)
        {
        	$response['code'] = '000001';
        	$response['msg'] = '没有此用户！';
                header('Content-type:text/html; Charset=utf8');  
                header( "Access-Control-Allow-Origin:*");  
                header('Access-Control-Allow-Methods:POST');    
                header('Access-Control-Allow-Headers:x-requested-with,content-type');
                die(json_encode($response));
        }
        $res = $this->getUserInfo($username);
        $userid = $res['userid'];
        $favoritecount = $this->checkfavorite($userid,$targetid);
        if($favoritecount >= 1)
        {   
            $response['code'] = '000001';
            $response['msg'] = '你已经关注过改产品！';
            header('Content-type:text/html; Charset=utf8');  
            header( "Access-Control-Allow-Origin:*");  
            header('Access-Control-Allow-Methods:POST');    
            header('Access-Control-Allow-Headers:x-requested-with,content-type');
            die(json_encode($response));
        }
        $data['userid'] = $userid;
        $data['createTime'] = date("Y-m-d H:i:s");
        $data['targetid'] = $targetid;
        $data['favoriteType'] = 1;
        $Favorites = D('favorites');
        $C = $Favorites->add($data);
        if($C)
        {
                $response['code'] = '000008';
                $response['msg'] = '成功关注商品！';
        }
        else
        {
                $response['code'] = '000002';
                $response['msg'] = '关注商品失败！';
        }
        header('Content-type:text/html; Charset=utf8');  
        header( "Access-Control-Allow-Origin:*");  
        header('Access-Control-Allow-Methods:POST');    
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        die(json_encode($response));
	}
        public function checkfavorite($userid,$targetid)
        {
            $Favorites = M('favorites');
            return $Favorites->where(['userid'=>$userid,'targetid'=>$targetid])->count();
        }
	/**
	 * 取消关注商品
	 * @return [type] [description]
	 */
	public function cancel()
	{
         $productid = I('post.productid');
         $username = I('post.loginName');
         $count = $this->checkUser($username);
         $UserInfo = $this->getUserInfo($username);
         $userid = $UserInfo['userid'];
         if($count != 1)
         {
            
                $response['code'] = '000001';
        	$response['msg'] = '没有此用户！';
         }
         else
         {
            $res = $this->deletefavorite($productid,$userid);
            if($res)
            {
            	$response['code'] = '000008';
        	$response['msg'] = '成功取消收藏的商品！';
            }
            else
            {
            	$response['code'] = '000002';
            	$response['msg'] = '取消收藏商品失败！';
            }
         }
         header('Content-type:text/html; Charset=utf8');  
         header( "Access-Control-Allow-Origin:*");  
         header('Access-Control-Allow-Methods:POST');    
         header('Access-Control-Allow-Headers:x-requested-with,content-type');
         die(json_encode($response));
	}
	/**
	 * 验证用户的合法性
	 */
	public function checkUser($username)
	{
		$Users = M('users');
		return $Users->where(['loginName'=>$username])->count();
	}
	/**
	 * 获取用户信息
	 */
	public function getUserInfo($username)
	{
		$Users = M('users');
		return $Users->where(['loginName'=>$username])->find();
	}
	/**
	 * 获取用户关注的商品信息
	 */
	public function getUserFavoritesInfo($userid)
	{
                $Nowdate = date("Y-m-d H:i:s");
                //全部产品的条件
                $con['hqjhc_goods.dataFlag'] = self::DATAFLAG;
                $con['hqjhc_grade.dataFlag'] = self::DATAFLAG;
                $con['hqjhc_grade.enddate'] = ['gt',$Nowdate];
                $con['hqjhc_favorites.userid'] = $userid;
                $field = '
                hqjhc_goods.brandid as brandid,
        	hqjhc_goods.name as goodname,
        	hqjhc_goods.goods_price as goods_price,
        	hqjhc_goods.description as description,
        	hqjhc_goods.marketPrice as marketPrice,
        	hqjhc_goods.goods_other_img1 as goods_other_img1,
        	hqjhc_goods.goods_other_img2 as goods_other_img2,
        	hqjhc_goods.goods_other_img3 as goods_other_img3,
                hqjhc_goods.goods_other_img4 as goods_other_img4,
                hqjhc_goods.id as id,
                hqjhc_grade.enddate as enddate,
                hqjhc_grade.startdate as startdate';                
                $Favorites = M('favorites');
                //全部产品信息
                $productinfos = $Favorites
                ->field($field)
                ->join(' LEFT JOIN hqjhc_goods ON  hqjhc_favorites.targetid = hqjhc_goods.id')
                ->join(' LEFT JOIN hqjhc_grade ON  hqjhc_grade.brandid = hqjhc_goods.brandid')
                ->where($con)
                ->select();
               foreach ($productinfos as $k => $v)
               { 
                   $brandid = $v['brandid'];
                   $Brands = M('brands');
                   $id = $v['id'];
                   $Info = $Brands->where(['brandid'=>$brandid])->find();
                   $productinfos[$k]['brandName'] = $Info['brandname'];
                   $productinfos[$k]['brandLogo'] = $Info['brandlogo'];
                   $productinfos[$k]['description'] = strip_tags(htmlspecialchars_decode($v['description']));
                   
                   
                        $count = $this->getproductsharestatus($id,$userid);
                        if($count >= 1)
                        {
                            $productinfos[$k]['sharestatus'] = 1;
                        }else
                        {
                            $productinfos[$k]['sharestatus'] = 0;
                        }

               }
                return $productinfos;
	}
        //分享状态
        public function getproductsharestatus($goodsid,$userid)
        {
            $Share = D('share');
            return $Share->where(['userid'=>$userid,'productid'=>$goodsid])->count();
        }
	/**
	 * 删除收藏的商品
	 */
	public function deletefavorite($productid,$userid)
	{
		$Favorites = D('favorites');
                return $Favorites->where(['targetid'=>$productid,'userid'=>$userid])->delete();
	}
}