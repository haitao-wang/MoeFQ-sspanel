<?php


namespace Ss\User;


class Reg {

    private $db;

    private $table = "user";
    
    private $gigabytes = 1073741824;

    function __construct(){
        global $db;
        $this->db = $db;
    }

    function GetLastPort(){
        $datas = $this->db->select($this->table,"*",[
            "role" => "user",
            "ORDER" => "uid DESC",
            "LIMIT" => 1
        ]);
        return $datas['0']['port'];
    }
    
    /**
     * SSPanel 二次开发：获取VIP最后的端口
     */
     function getVipLastPort(){
        $datas = $this->db->query("SELECT * FROM user WHERE `role`='vip1' or `role` = 'vip2' ORDER BY `uid` DESC LIMIT 1");
        return $datas['0']['port'];
     }

    function Reg($username,$email,$pass,$plan,$transfer,$invite_num,$ref_by,$role,$inviter,$question,$answer){

        if($inviter != 0)
            $transfer = $transfer + 1073741824;

        $sspass = \Ss\Etc\Comm::get_random_char(8);

        $this->db->insert($this->table,[
           "user_name" => $username,
            "email" => $email,
            "pass" => $pass,
            "passwd" =>  $sspass,
            "t" => '0',
            "u" => '0',
            "d" => '0',
            "plan" => $plan,
            "transfer_enable" => $transfer,
            "port" => $this->GetLastPort()+1,
            "invite_num" => $invite_num,
            "money" => '0',
            "#reg_date" =>  'NOW()',
            "ref_by" => $ref_by,
            "invite_by"=>$inviter,
            "role" => $role,
            "question" => $question,
            "answer" => $answer
        ]);
        /*
        if($inviter != 0){
            $query = $this->db->query("SELECT * FROM user WHERE `uid`={$inviter}");
            $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
            //$able = intval($result['transfer_enable'])+$this->gigabytes;
            $able = $result['transfer_enable'];
            $this->db->query("UPDATE user SET `transfer_enable` = $able WHERE uid = $inviter");
        }
        */

    }

}