<?php
/** MoeFQ Cron Tabs 文件 // Create By Kotori */
require 'config.php';
date_default_timezone_set('Asia/Shanghai'); 
$date = @date('Ymd');
$cronLastDo = $ko->getOption('cron');
if($cronLastDo == $date){
    exit;
}
else{
    $query = $ko->db()->query("SELECT * FROM user WHERE `role_timeout` != 0 ") or die(mysqli_error($ko->db()));
    while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
        $uid = $result['uid'];
        $newTimeOut = $result['role_timeout'] - 1;
        $update = $ko->db()->query("UPDATE user SET `role_timeout` = '{$newTimeOut}' WHERE `uid` = '{$uid}'")
        or die(mysqli_error($ko->db()));
    }
    $ko->update('cron',$date);
    echo $date.' : Cron Finished! Cron created by Kotori.';
}