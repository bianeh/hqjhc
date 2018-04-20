<?php
class timing_order{
    public function index()
    {           
                
                header("content-type:text/html;charset=utf-8");
		$dsn = "mysql:dbname=hqjhc;host=127.0.0.1";
		$db_user = 'root';
		$db_pass = '%Hqjhc%';
		try{
			$pdo = new PDO($dsn,$db_user,$db_pass);
		}catch(PDOException $e)
		{
			echo "数据库连接失败".$e->getMessage();
		}
                $sql =" SELECT * FROM hqjhc_orders WHERE orderStatus = 0 ";
                $ordersInfo = $pdo->query($sql)->fetchAll();
                
                file_put_contents('jjjjj.txt', json_encode($ordersInfo));
                
		foreach ($ordersInfo as $key => $value) {
                        $speca = $value['spec1'];
                        $specb = $value['spec2'];
                        $userid = $value['userid'];
                        $num = $value['num'];
                        $goodsid = $value['goodsid'];
                        $orderno = $value['orderNo'];
                        $this->update_orders_status($orderno);
                        $this->update_goods_spec_num($num,$goodsid,$speca,$specb);
                        $this->update_goods_num($goodsid,$num);
		}

    }
    //更新订单状态
    public function update_orders_status($orderno)
    {
        $sql = " UPDATE hqjhc_orders SET orderStatus = 6 WHERE orderNo = $orderno ";
        $pdo->exec($sql);
    }
    //更新规格库存
    public function update_goods_spec_num($num,$goodsid,$speca,$specb)
    {
        $sql = " UPDATE hqjhc_goods_specs SET specnum = specnum + $num WHERE goodsid= $goodsid AND speca = speca AND specb =specb AND goodsid = $goodsid ";
        $pdo->exec($sql);
    }
    //更新商品总库存
    public function update_goods_num($goodsid,$num)
    {
        $sql = " UPDATE hqjhc_goods SET number = number + $num WHERE goodsid = $goodsid ";
        $pdo->exec($sql);
    }
}
$exec = new timing_order();
$exec->index();
?>
