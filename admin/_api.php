<?php
/** MoeFQ 魔改 SSPanel 新增接口 Plugined by Kotori */
require_once '../lib/config.php';
if(isset($_GET['act']))
	$action = $_GET['act'];
else
	exit;

switch($action){

	case 'notice':
	if(isset($_POST['noticeOne']) && isset($_POST['noticeTwo'])){
		$query = $ko->update('notice',$_POST['noticeOne'],$_POST['noticeTwo']);
		$status['code'] = '1';
		$status['msg'] = '成功地修改了公告！';
		echo json_encode($status);
	}
	else{
	    return false;
		exit;
	}
	break;

	case 'paycode':
	if(isset($_POST['number']) && isset($_POST['size']) && isset($_POST['salt'])){
		$number = $_POST['number'];
		$size = $_POST['size'];
		$salt = $_POST['salt'];
		$ko->payCode($number,$size,$salt);
		$a['code'] = 1;
        	$a['number']=$number;
        	$a['size']=$size;
        	echo json_encode($a);
	}
	else{
		echo '23333';
		exit;
	}
	break;

}