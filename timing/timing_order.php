<?php
class timing_order
{
    public function index()
    {                  
        header("content-type:text/html;charset=utf8");
        $dsn = "mysql:dbname=hqjhc;host=127.0.0.1";
        $db_user = 'root';
        $db_pass = '%Hqjhc%';
        try{    
                $pdo = new PDO($dsn,$db_user,$db_pass);
                $pdo->query("SET NAMES utf8");
        }catch(PDOException $e)
        {
                echo "数据库连接失败".$e->getMessage();
        }
        $NowTime = time();
        $CompareTime = date("Y-m-d H:i:s",$NowTime - 60*30);
        $sql =" SELECT * FROM hqjhc_orders WHERE orderStatus = 0 and createTime <  date_sub(NOW(),interval 30 minute)";
        $ordersInfo = $pdo->query($sql)->fetchAll(); 
        foreach ($ordersInfo as $key => $value) 
        {
            $speca = $value['spec1'];
            $specb = $value['spec2'];
            $userid = $value['userid'];
            $num = $value['num'];
            $goodsid = $value['goodsid'];
            $orderno = $value['orderNo'];    
            
            $info = "长时间未交易，你的订单号".$orderno."已回收";
            $createTime = date('Y-m-d h:i:s',time());
//            $sql = " INSERT INTO hqjhc_web_notify(title,info,userid,source) VALUES('订单回收',$title,$userid,'订单超时回收') ";
            $sql = " INSERT INTO hqjhc_web_notify(title,info,userid,source) VALUES('订单回收','".$info."',$userid,'订单回收') ";
            $pdo->query($sql);
            
            
            
            $sql = " UPDATE hqjhc_orders SET orderStatus = 6 WHERE orderNo = $orderno ";
            $pdo->query($sql);
            
            $sql = " UPDATE hqjhc_goods_specs SET specnum = specnum + $num WHERE goodsid= $goodsid AND speca = $speca AND specb = $specb ";
            $pdo->query($sql);                       
            $sql = " UPDATE hqjhc_goods SET number = number + $num WHERE goodsid = $goodsid ";
            $pdo->query($sql);
            
        }
    }
}
$exec = new timing_order();
$exec->index();
?>
