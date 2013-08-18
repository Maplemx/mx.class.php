<?php
//数据库操作类
class mysql{
	var $dbConn;
	var $dbSelect;
	var $errCount;
	var $err;
	//打开数据库
	function openDb(){
		/*数据库基本参数*/
		$dbHost = 'localhost';
		$dbUsername = 'username';
		$dbPassword = 'password';
		$dbDatabase = 'database';
		/*------------*/
		try{
			$this->dbConn = mysql_connect($dbHost,$dbUsername,$dbPassword);
			if (!$this->dbConn){
				throw new Exception(mysql_error());
			}
			$this->dbSelect = mysql_select_db($dbDatabase,$this->dbConn);
			if (!$this->dbSelect){
				throw new Exception(mysql_error());
			}
			return true;
		}catch(Exception $e){
			$this->errCount++;
			$this->err[$this->errCount] = $e->getMessage();
		}
	}
	//关闭数据库
	function closeDb(){
		mysql_close();
	}
	//直接执行SQL
	function runSQL($sql){
		try{
			$result = mysql_query($sql,$this->dbConn);
			if ($result){
				return true;
			}else{
				throw new Exception('【SQL】'.$sql.'<br />【Error】'.mysql_error());
			}
		}catch(Exception $e){
			$this->errCount++;
			$this->err[$this->errCount] = $e->getMessage();
		}
	}
	//返回数据库查询结果
	function getData($sql){
		try{
			$result = mysql_query($sql,$this->dbConn);
			if ($result){
				$i = 0;
				while ($row = mysql_fetch_array($result,MYSQL_ASSOC)){
					$res[$i] = $row;
					$i++;
				}
				return $res;
			}else{
				throw new Exception('【SQL】'.$sql.'<br />【Error】'.mysql_error());
			}
		}catch(Exception $e){
			$this->errCount++;
			$this->err[$this->errCount] = $e->getMessage();
		}
	}
	//返回错误列表
	function errList(){
		echo json_encode(array('error Count'=>$this->errCount,'error List'=>$this->err));
	}
}