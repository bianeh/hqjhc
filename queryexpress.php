<?php
    $expressname = $_GET['expressname'];
    $expressno = $_GET['expressno'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>物流查询</title>
	<script type="text/javascript" src="/plugins/kdniao/jquery.min.js"></script>
	<script type="text/javascript" src="/plugins/kdniao/kdniao.js"></script>
</head>
<body>
</body>
<script type="text/javascript">
	$(
       function()
         {
           kdniao.init();
	 });
        window.onload = function()
        {
            kdniao.query('<?php echo $expressno ?>','<?php echo $expressname ?>');
        }
</script>
</html>