<?php
/**
* Kotori.php - MoeFQ SSPanel 二次开发函数封装类
* @copyright 2015(c) Minami-Kotori
*/

/** 2015/8/10   将原生的MySQL全部使用 Medoo 改写，防止SQL注入 */

class Kotori{

	var $dbhost = DB_HOST;
	var $dbuser = DB_USER;
	var $dbpass = DB_PWD;
	var $dbname = DB_DBNAME ;
	private $db;
	private $dbcontent;
	
	function __construct(){
		global $db;
		$this->db  = $db;
	}



	public function db(){
		$this->dbcontent = new mysqli($this->dbhost,$this->dbuser,$this->dbpass,$this->dbname,3306);
		$this->dbcontent->query('SET NAMES UTF8');
		return $this->dbcontent;
	}
	

	/**
	* 获取 moefq_option 表选项
	* @param $optionName 选项名称
	* @param $return 返回内容
	*/
	public function getOption($optionName,$return = 'value'){
		$query = $this->db->select("moefq_option","*",[
			"name"=>$optionName
			]);
		return $query['0'][$return];
		//$query = $this->db()->query("SELECT * FROM moefq_option WHERE name='{$optionName}' ");
		//$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
		//return $result[$return];
	}
	
	/**
	 * 向 moefq_option 表写入数据
	 * @param $name 选项名称
	 * @param $value 选项主值
	 * @param $subvalue 选项附加值
	*/
	public function newOption($name,$value,$subvalue = ''){
		$query = $this->db->insert("moefq_option",[
			"name"=>$name,
			"value"=>$value,
			"subvalue"=>$subvalue
			]);
		//$query = $this->db()->query("INSERT INTO moefq_option (`name`,`value`,`subvalue`) VALUES ('{$name}','{$value}','{$subvalue}')");
		if($query) return true; else return false;
	}
	
	/**
	 * 更新 moefq_option 表数据
	 * @param $name 选项名称
	 * @param $value 选项主值
	 * @param $subvalue 选项附加值
	 */
	public function update($name,$value,$subvalue = ''){
		//$query = $this->db()->query("UPDATE moefq_option SET `value`='{$value}',`subvalue`='{$subvalue}' WHERE `name`='{$name}'") or die(mysqli_error($this->db()));
		$query = $this->db->update("moefq_option",[
			"value"=>$value,
			"subvalue"=>$subvalue
			],[
			"name"=>$name
			]);
		if($query) return true; else return false;
	}

	 /**
	  * 更新 user 表内容
	  * @param $name 要修改的字段名称
	  * @param $value 修改的字段的值
	  * @param $uid 用户的UID
	  */
	 public function updateUserInfo($name,$value,$uid){
	 	//$query = $this->db()->query("UPDATE user SET `{$name}` = '{$value}' WHERE `uid` = {$uid}");
	 	$query = $this->db->update("user",[
	 		$name=>$value
	 		],[
	 		"uid"=>$uid
	 		]);
	 	if($query) return true; else; return false;
	 }

	 /**
	  * 获取 user 表内容
	  * @param $name 要获取的字段名称
	  * @param $uid 用户的UID
	  * -----------------------------
	  * 通过其他方式获取 user 表内容
	  * @param $name 要获取的字段名称
	  * @param $selectName 要选取的字段名称
	  * @param @selectValue 要选取的字段的值
	  */
	 public function kotoriNeedInfo($name,$uid){

	 	//$query = $this->db()->query("SELECT * FROM user WHERE `uid` = {$uid}");
	 	//$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
	 	$data = $this->db->select("user","*",[
	 		"uid"=>$uid,
	 		"LIMIT"=>1
	 		]);
	 	//return $result[$name];
	 	return $data['0'][$name];
	    }

	    public function kotoriFindKotori($name,$selectName,$selectValue){
	    	//$query = $this->db()->query("SELECT * FROM user WHERE `{$selectName}` = '{$selectValue}'");
	    	//$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
	    	$data = $this->db->select("user","*",[
	    		$selectName=>$selectValue,
	    		"LIMIT"=>1
	    		]);
	    	//return $result[$name];	      
	    	return $data['0'][$name];
	    }

	  /**
	   * Count 操作检测重复
	   * @param $name WHERE条件名称
	   * @param $value 字段的值
	   * @param $table 分表
	   */
	  public function checkRepeat($name,$value,$table = 'user'){
	  	$query = $this->db()->query("SELECT COUNT(*) AS total FROM {$table} WHERE `{$name}` = '{$value}'");
	  	$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
	  	return $result['total'];
	  }

	   /**
	    * 在不调用 reg 接口的情况下获取最后一个端口
	    * @param $role 用户角色
	    */
	   public function getLastPort($role){
	   	//$query = $this->db()->query("SELECT * FROM user WHERE `role` = '{$role}' ORDER BY `port` DESC LIMIT 1");
	   	//$datas = mysqli_fetch_array($query);
	   	$datas = $this->db->select("user","*",[
	   		"role"=>$role,
	   		"ORDER"=>"port DESC",
	   		"LIMIT"=>1
	   		]);
	   	return $datas['0']['port'];
	   }

        /**
         * 这是一个重复的接口，在SS\User\UserInfo中有类似接口，但是为了方便，把她独立出来
         * @param $uis 用户uid
         */
        public function getUserPermission($role){
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
        	return $permission;
        }
        /**
         * payCode 生成付款码函数
         * @param  int $number 生成付款码的个数
         * @param  int $size   生成付款码的面值（萌币）
         * @param  [type] $salt  生成付款码用的盐
         * @return boolean
         */
        public function payCode($number,$size,$salt){
        	for($time = 0; $time<$number ; $time++){
        		$rander = array();
        		$moe = '';
        		for($i=1;$i<20;$i++){
        			$rander[$i] = chr(rand(97,122));
        			$moe = $moe.$rander[$i-1];
        		}
        		$moe = $moe.$salt.$size;
        		$payCode = md5(md5($moe));
        		//$this->db()->query("INSERT INTO moefq_code (`code`,`size`) VALUES ('{$payCode}','{$size}')");
        		$this->db->insert("moefq_code",[
        			"code"=>$payCode,
        			"size"=>$size
        			]);
        	}
        	return true;
        }

      }