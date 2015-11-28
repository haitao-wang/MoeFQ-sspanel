<?php
require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");

require_once '../lib/config.php';
?>
<!DOCTYPE HTML>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功

	$out_trade_no = $_GET['out_trade_no'];
	$trade_no = $_GET['trade_no'];
	$trade_status = $_GET['trade_status'];
	$total_fee = $_GET['total_fee'];


    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
		$sql="select `email`,`amount` from `ss_order` where `state`=0 and `orderno`='".$out_trade_no."'";
		$query = $ko->db()->query($sql);
		 if(!$query){
			
		 }else{
			  $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
			  $email=$result['email'];
			  $amount=$result['amount'] * 10;
			  $ko->db()->query("UPDATE ss_order SET `state` ='1'  where `state`=0 and `orderno`='".$out_trade_no."'");
			  
			  $ko->db()->query("UPDATE `user` SET `money` =`money`+".$amount."  where `email`='".$email."'");
		 }
		  echo "支付成功<script>window.location.href='../user/my.php';</script>";
    }
    else {
      echo "支付失败";
    }
}
else {
    echo "验证失败";
}
?>
        <title>支付宝即时到账交易接口</title>
	</head>
    <body>
    </body>
</html>