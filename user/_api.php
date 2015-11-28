<?php
require_once '../lib/config.php';
if(isset($_GET['act']))
    $action = $_GET['act'];
else
    exit;
$ko = new kotori();
function roleChange($db,$ko,$result,$role,$timeout,$usedMoney,$uid){
    switch($role){
        case 'vip1':
        $transfer = 53687091200;
        $port = $ko->getLastPort('vip1')+1;
        break;
        case 'vip2':
        $transfer = 107374182400*2;
        $port = $ko->getLastPort('vip2')+1;
        break;
        case 'user':
        $transfer = 6442450944;
        $port = $ko->getLastPort('user')+1;
        break;
    }
    $db->insert("user",[
        "uid" => $result['uid'],
        "user_name" => $result['user_name'],
        "email" => $result['email'],
        "pass" => $result['pass'],
        "passwd" =>  $result['passwd'],
        "t" => $result['t'],
        "u" => $result['u'],
        "d" => $result['d'],
        "plan" => $result['plan'],
        "transfer_enable" => $transfer,
        "port" => $port,
        "invite_num" => $result['invite_num'],
        "money" => $result['money']-$usedMoney,
        "reg_date" =>  $result['reg_date'],
        "ref_by" => $result['ref_by'],
        "invite_by"=>$result['invite_by'],
        "role" => $role,
        "question" => $result['question'],
        "answer" => $result['answer'],
        "role_timeout" => $result['role_timeout'] + $timeout
        ]);
    return true;
}

switch($action){

    case 'question':
    if(isset($_POST['question']) && isset($_POST['answer'])){
        $question = addslashes($_POST['question']);
        $answer = addslashes($_POST['answer']);
        $uid = $_POST['uid'];
        $q = $ko->updateUserInfo('question',$question,$uid);
        $e = $ko->updateUserInfo('answer',$answer,$uid);
        $a['msg'] = '修改成功，密保问题已更新。';
        echo json_encode($a);
    }
    else{
        return false;
        exit;
    }
    break;
    
    case 'getquestion':
    if(isset($_POST['email'])){
        $question = $ko->kotoriFindKotori('question','email',$_POST['email']);
        if(!empty($question)){
            $a['question'] = '此帐号的密保问题：'.$question;
            $a['result'] = 1;
        }
        else{
            $a['result'] = 2;
        }
        echo json_encode($a);
    }
    else{
        return false;
        exit;
    }
    break;

    case 'paycode':
    require_once '_check.php';
    if(isset($_POST['uid']) && isset($_POST['code']) && $_POST['uid'] == $uid){
        $code = $_POST['code'];
        $checkCode = $ko->db()->query("SELECT COUNT(*) AS total FROM moefq_code WHERE `code`='{$code}' ");
        if(!$checkCode) die('failed:code 200');
        $checkResult = mysqli_fetch_array($checkCode,MYSQLI_ASSOC);
        if($checkResult['total'] == 0)
            die('failed:code 233');
        else{
            $query = $ko->db()->query("SELECT * FROM moefq_code WHERE `code` = '{$code}' ORDER BY `size` ASC LIMIT 1");
            $res = mysqli_fetch_array($query,MYSQLI_ASSOC);
            $size = $res['size'];
            $extra = $ko->kotoriNeedInfo('money',$uid);
            $nowExtra = $extra+$size;
            $ko->updateUserInfo('money',$nowExtra,$uid);
            $ko->db()->query("DELETE FROM moefq_code WHERE `code` = '{$code}' ");
            $a['code']='1';
            $a['msg']='success';
            $a['size']=$size;
            $a['extra']=$nowExtra;
            echo json_encode($a);
        }
    }
    break;
    
    case 'portrecycle':
    require_once '_check.php';
    if(isset($_POST['uid']) && $_POST['uid']==$uid){
            /*
            $port = $ko->getLastPort()+1;
            $ko->updateUserInfo('port',$port,$uid);
            $ko->updateUserInfo('role','user',$uid);
            $ko->updateUserInfo('role_timeout',0,$uid);
            */
            $data = $db->select("user","*",[
                "uid"=>$uid,
                "LIMIT"=>"1"
                ]);
            $result = $data['0'];
            $db->delete("user",[
                "uid"=>$uid
                ]);
            
            roleChange($db,$ko,$result,'user','0','0');
            
            //$ko->roleChange($result,'user','0','0');
            $a['code'] = 0;
            $a['msg'] = "您的VIP身份已经注销，我们已经为您分配了新的端口，您现在仍然可以使用我们的免费服务。感谢您对MoeFQ一直以来的支持。\n\n请记得更新您的ShadowSocks客户端的连接信息哦。";
            echo json_encode($a);
        }
        else{
            $a['code'] = 1;
            $a['msg'] = '身份注销失败，提交的请求和您登录的用户身份不符合.';
            echo json_encode($a);
        }
        break;
        
        case 'openvip':
        require_once '_check.php';
        if(isset($_POST['uid']) && $_POST['uid'] == $uid){
            $plus = '';
            $data = $db->select("user","*",[
                "uid"=>$uid,
                "LIMIT"=>"1"
                ]);
            $result = $data['0'];
            if(isset($_POST['paymethod']) && isset($_POST['type']) && isset($_POST['confirm'])){
                $payMethod = $_POST['paymethod'];
                $type = $_POST['type'];
                if($payMethod == 'month') {$timeout = 30; if($type=='vip1') $usedMoney = 100; else $usedMoney = 200;}
                elseif($payMethod == 'year'){$timeout = 365; if($type=='vip1') $usedMoney = 1000; else $usedMoney = 2000;}
                if($usedMoney > $ko->kotoriNeedInfo('money',$uid)){
                    $a['code'] = 3;
                    $a['msg'] = "开通VIP失败惹，原因是您的余额不足，充值完了再来吧w。";
                }
                else{
                    $db->delete("user",[
                        "uid"=>$uid
                        ]);
                    $nowRole = $ko->kotoriNeedInfo('role',$uid);

                    if($ko->getUserPermission($nowRole) < $ko->getUserPermission($type)){
                        $result['role_timeout'] = $result['role_timeout'] / 2;
                        $plus = "\n\n由于您原来的权限比现在开通的小，我们已经将您原来的身份过期时间折半，并合并到新的身份有效期中。如有疑问，请联系管理员。";
                    }

                    $doItNow = roleChange($db,$ko,$result,$type,$timeout,$usedMoney,$uid);
                    $a['code'] = 0;
                    $a['timeout'] = $ko->kotoriNeedInfo('role_timeout',$uid);
                    $a['msg'] = "VIP 开通成功啦，有效期还有 ".$a['timeout']." 天，已经为您分配了新的ShadowSocks连接端口，请您注意修改配置信息。\n\n如果未生效，则可能是由于节点数据库缓存的原因，请联系管理员。希望您能够使用愉快，感谢您对MoeFQ的支持。".$plus;
                }
                echo json_encode($a);
                
            }
            else{
                $a['code'] = 1;
                $a['msg'] = '开通失败，非法操作。';
                echo json_encode($a);
            }
        }
        else{
            $a['code'] = 2;
            $a['msg'] = '开通失败，提交的请求和您登录的用户身份不符合.';
            echo json_encode($a);
        }
        break;
        
        
    }