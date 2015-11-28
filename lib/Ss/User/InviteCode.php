<?php
/**
 * class moefq_invite
 */
namespace Ss\User;

class InviteCode {

    public $code;
    private $dbc;
    private $db;

    private $table = "moefq_invite";


    function  __construct($code=0){
        global $dbc;
        global $db;
        $this->code = $code;
        $this->dbc  = $dbc;
        $this->db   = $db;
    }

    //邀请码是否有效检测
    function IsCodeOk(){
        if($this->db->has("moefq_invite",[
            "code" => $this->code
        ])){
            return 1;
        }else{
            return 0;
        }
    }

    function GetCodeArray(){
        $datas = $this->db->select($this->table,"*",[
            "code" => $this->code
        ]);
        return $datas['0'];
    }

    function GetCodeUser(){
        return $this->GetCodeArray()['user'];
    }

    //删除邀请码
    function Del(){
        $this->db->delete("moefq_invite",[
            "code[=]" => $this->code,
            "LIMIT" => 1
        ]);
    }

    function AddCode($sub,$user,$num){
        for($a=0;$a<$num;$a++) {
            $x = rand(10, 1000);
            $z = rand(10, 1000);
            $x = md5($x).md5($z);
            $x = base64_encode($x);
            $code = $sub.substr($x, rand(1, 13), 24);
            $this->db->insert("moefq_invite",[
                "code" => $code,
                "user" => $user
            ]);
        }
    }


}