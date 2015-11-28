<?php
require_once '../lib/config.php';
$email = $_POST['email'];
$email = addslashes(strtolower($email));
$passwd = $_POST['passwd'];
$name = addslashes($_POST['name']);
$repasswd = $_POST['repasswd'];
$code = addslashes($_POST['code']);
$role = 'user';
$question = addslashes($_POST['question']);
$answer = addslashes($_POST['answer']);
if(isset($_POST['inviter']))
    $inviter = addslashes($_POST['inviter']);
else
    $inviter = 0;

$c = new \Ss\User\UserCheck();
$code = new \Ss\User\InviteCode($code);
if(!$code->IsCodeOk()){
    $a['msg'] = "邀请码无效";
}elseif(!$c->IsEmailLegal($email)){
    $a['msg'] = "邮箱无效";
}elseif($c->IsEmailUsed($email)){
    $a['msg'] = "邮箱已被使用";
}elseif($repasswd != $passwd){
    $a['msg'] = "两次密码输入不符";
}elseif(strlen($passwd)<8){
    $a['msg'] = "密码太短";
}elseif(strlen($name)<5){
    $a['msg'] = "用户名太短";
}elseif($c->IsUsernameUsed($name)){
    $a['msg'] = "用户名已经被使用";
}elseif(empty($question)){
    $a['msg'] = "密保问题没有填写";
}elseif(empty($answer)){
    $a['msg'] = "密保回答无效或没有填写";  
}else{
         if($inviter != 0){
            $query = $ko->db()->query("SELECT * FROM user WHERE uid='{$inviter}'");
            $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
            $able = $result['transfer_enable'] + 1073741824;
            $ko->db()->query("UPDATE user SET `transfer_enable` = {$able} WHERE uid = {$inviter}");
        }
    // get value
    $ref_by = $code->GetCodeUser();
    $passwd = \Ss\User\Comm::SsPW($passwd);
    $plan = "A";
    $transfer = 6442450944;
    $invite_num = rand($user_invite_min,$user_invite_max);
    //do reg
    $reg = new \Ss\User\Reg();
    $reg->Reg($name,$email,$passwd,$plan,$transfer,$invite_num,$ref_by,$role,$inviter,$question,$answer);
    $code->Del();
    $a['ok'] = '1';
    $a['msg'] = "注册成功!";
}
echo json_encode($a);
