<?php
require_once '../lib/config.php';
require_once '_check.php';

$a['msg'] = '个人资料已更新。' ;

if($_POST['nickname']==''){
    $nickname = 'Undefined Name';
}
else{
    $nickname = $_POST['nickname'];
}

if($_POST['email'] == $U->GetEmail()){}
else{
    $lastEmail = $ko->kotoriNeedInfo('last_email',$uid);
    if(empty($lastEmail)){
        $lastEmail = $U->GetEmail();
        $newEmail = $_POST['email'];
        if($ko->checkRepeat('email',$newEmail) != '0'){
            $a['msg'] = '修改邮箱时发生错误，邮箱已经被使用，请您联系管理员。';
        }
        else{
            $ko->updateUserInfo('email',$newEmail,$uid);
            $ko->updateUserInfo('last_email',$lastEmail,$uid);
        }

    }else{
        $a['msg'] = '修改邮箱时发生错误，您半年内已经修改过一次邮箱，请您联系管理员。';
    }
}

$ko->updateUserInfo('user_name',$nickname,$uid);

$a['status'] = 1;

echo json_encode($a);