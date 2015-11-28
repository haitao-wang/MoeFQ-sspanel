<?php

namespace Ss\User;


class UserInfo {

    public  $uid;
    private $db;

    private $table = "user";

    function __construct($uid=0){
        global $db;
        $this->uid = $uid;
        $this->db  = $db;
    }

    //user info array
    function UserArray(){
        $datas = $this->db->select($this->table,"*",[
            "uid" => $this->uid,
            "LIMIT" => "1"
        ]);
        return $datas['0'];
    }

    function GetPasswd(){
        return $this->UserArray()['pass'];
    }

    function GetEmail(){
        return $this->UserArray()['email'];
    }

    function GetUserName(){
        return $this->UserArray()['user_name'];
    }

    function RegDate(){
        return $this->UserArray()['reg_date'];
    }

    function RegDateUnixTime(){
        return strtotime($this->RegDate());
    }

    function InviteNum(){
        return $this->UserArray()['invite_num'];
    }
    
    /** 拓展：获取用户的权限（By Kotori） */
    function UserRole(){
        $role =  $this->UserArray()['role'];
        switch($role){
            case 'admin':
                return '管理员';
                break;
            case 'vip1':
                return 'VIP1';
                break;
            case 'vip2':
                return 'VIP2';
                break;
            case 'user':
                return '注册用户';
                break;
            default:
                return '注册用户';
                break;
        }
    }

    /** 
    * 拓展：节点展示——可以看到分类为x的节点（By Kotori）
    * @param $sort 节点分类
     */
    function UserRoleNode($sort){
        $role = $this->UserArray()['role'];
        switch($role){
            case 'admin':
                $permission = 666;
                break;
            case 'vip1':
                 $permission = 1;
                break;
            case 'vip2':
                 $permission = 2;
                break;
            case 'user':
                 $permission = 0;
                break;
            default:
                 $permission = 0;
                break;
        }
        if($permission >= $sort)
            return true;
        else
            return false;
    }
    
    /**
     * 拓展：用户推广链接获取&&推广数量查询(By Kotori)
     */
     function userSpreadLink(){
         return 'http://portal.moefq.com/user/register.php?inviter='.$this->uid;
     }
     function userInviteNum(){
        $total = $this->db->count($this->table,"uid",["invite_by" => $this->uid]);
        return $total;
     }

    function InviteNumToZero(){
        $this->db->update("user",[
            "invite_num" => '0'
        ],[
            "uid" => $this->uid
        ]);
    }

    function Money(){
        return $this->UserArray()['money'];
    }

    function AddMoney($money){
        $this->db->update("user",[
            "money[+]" => $money
        ],[
            "uid" => $this->uid
        ]);
    }

    function GetRefCount(){
        $c = $this->db->count($this->table,"uid",[
            "ref_by" => $this->uid
        ]);
        return $c;
    }

    function UpdatePwd($pass){
        $this->db->update("user",[
            "pass" => $pass
        ],[
            "uid" => $this->uid
        ]);
    }

    function isAdmin(){
        if($this->db->has("ss_user_admin",[
            "uid" => $this->uid
        ])){
            return true;
        }else{
            return false;
        }
    }

    function DelMe(){
        $this->db->delete($this->table,[
            "uid" => $this->uid
        ]);
    }
}