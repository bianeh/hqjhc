<?php
class timing_message
{
    public function index()
    {    
        header("content-type:text/html;charset=utf-8");
        $dsn = "mysql:dbname=hqjhc;host=127.0.0.1";
        $db_user = 'root';
        $db_pass = '%Hqjhc%';
        try
        {
                $pdo = new PDO($dsn,$db_user,$db_pass);
                $pdo->query("SET NAMES utf8");
        }
        catch(PDOException $e)
        {
                echo "数据库连接失败".$e->getMessage();
        } 
        $sql =" SELECT * FROM hqjhc_mobile_message WHERE dataFlag = 0 and createTime <  date_sub(NOW(),interval 15 minute)";
        $messageInfo = $pdo->query($sql)->fetchAll(); 
        foreach ($messageInfo as $key => $value) 
        {     
              $id = $value['id'];
              $sql = " UPDATE hqjhc_mobile_message SET dataFlag = 1 WHERE id = $id ";
              $pdo->query($sql);
        }
    }
}
$exec = new timing_message();
$exec->index();
?>
