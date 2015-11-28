<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>支付宝即时到账交易接口接口</title>
</head>
<?php
require_once("alipay.config.php");
require_once("lib/alipay_submit.class.php");

require_once '../lib/config.php';

ini_set('display_errors','On');
error_reporting(E_ALL);
if (!ini_get('display_errors')) {
ini_set('display_errors', 'off');
}


$email=isset($_REQUEST["email"])?$_REQUEST["email"]:"";;
$amount=isset($_REQUEST["amount"])?$_REQUEST["amount"]:"";

if($email==""||$amount==""){
	 header("Location:../user/login.php");
    exit();
}


$amount=number_format($amount,2,".","");
        $payment_type = "1";
        $notify_url = "http://".$_SERVER['HTTP_HOST']."/alipay/notify_url.php";
        $return_url =  "http://".$_SERVER['HTTP_HOST']."/alipay/return_url.php";
        $out_trade_no = date("YmdHis").rand(1000,9999);
        $subject = "萌币充值www";
        $total_fee = $amount;
        $body = $out_trade_no;
        $show_url = "http://".$_SERVER['HTTP_HOST']."/";
        $anti_phishing_key = "";
        $exter_invoke_ip = "";


/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
		"service" => "create_direct_pay_by_user",
		"partner" => trim($alipay_config['partner']),
		"seller_email" => trim($alipay_config['seller_email']),
		"payment_type"	=> $payment_type,
		"notify_url"	=> $notify_url,
		"return_url"	=> $return_url,
		"out_trade_no"	=> $out_trade_no,
		"subject"	=> $subject,
		"total_fee"	=> $total_fee,
		"body"	=> $body,
		"show_url"	=> $show_url,
		"anti_phishing_key"	=> $anti_phishing_key,
		"exter_invoke_ip"	=> $exter_invoke_ip,
		"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
);

$sql="insert into `ss_order` (`email`,`orderno`,`amount`,`state`,`date`) values ('".$email."','".$out_trade_no."','".$total_fee."',0,now())";
$ko->db()->query($sql);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
echo $html_text;

?>
</body>
</html>