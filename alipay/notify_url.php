<?php
require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");

require_once '../lib/config.php';


//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {//验证成功
	
	$out_trade_no = $_POST['out_trade_no'];

	//支付宝交易号

	$trade_no = $_POST['trade_no'];

//交易状态
	$trade_status = $_POST['trade_status'];


    if($_POST['trade_status'] == 'TRADE_FINISHED'||$_POST['trade_status'] == 'TRADE_SUCCESS') {
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
    }
    else{
		
    }
	echo "success";		//请不要修改或删除
	
}
else {
    //验证失败
    echo "fail";

    //调试用，写文本函数记录程序运行情况是否正常
    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
}
?>