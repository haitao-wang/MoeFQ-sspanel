<?php
//设置编码
header("content-type:text/html;charset=utf-8");
require_once '../lib/config.php';


/**
 * SSPanel 二次开发 吟梦の重置方法
*/
if(isset($_POST['answer']) && isset($_POST['newpassword']) && isset($_POST['email'])){
    $ans = $_POST['answer'];
    $newpwd = $_POST['newpassword'];
    $email = $_POST['email'];
    $uid = $ko->kotoriFindKotori('uid','email',$email);
    if($ko->kotoriFindKotori('answer','email',$email) == $ans){
        $newpwd = \Ss\User\Comm::SsPW($newpwd);
        $ko->updateUserInfo('pass',$newpwd,$uid);
        $a['msg'] = '密码已修改，新的密码为'.$_POST['newpassword'].'，请牢记哦。';
    }
    else{
        $a['msg'] = '密码重置失败，密保答案无效哦。';   
    }
    echo json_encode($a);
}
else{
    return false;
    exit;
}

/***
//mailgun
require '../vendor/autoload.php';
use Mailgun\Mailgun;
$mg = new Mailgun($mailgun_key);
$domain = $mailgun_domain;
//
$email    = $_GET['email'];
$c = new \Ss\User\UserCheck();
$q = new \Ss\User\Query();
$a = [];
if($c->IsEmailUsed($email)){
    $uid = $q->GetUidByEmail($email);
    $rst = new \Ss\User\ResetPwd($uid);
    if($rst->IsAbleToReset()){
        $code = $rst->NewLog();
        //send
        # Now, compose and send your message.
        $mg->sendMessage($domain, array('from'    => "no-reply@".$mailgun_domain,
            'to'      => $email,
            'subject' => $site_name."重置密码",
            'text'    => '请访问此链接申请重置密码'.$site_url."/user/resetpwd_do.php?code=".$code."&uid=".$uid));

        $a['code'] = '1';
        $a['ok'] = '1';
        $a['msg']  =  "已经发送到邮箱";
    }else{
        $a['code'] = '1';
        $a['msg']  =  "24小时内申请超过上限";
    }
}else{
    $a['code'] = '0';
    $a['msg']  =  "邮箱不存在";
}
echo json_encode($a);
*/
