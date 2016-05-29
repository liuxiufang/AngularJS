<?php
/**
 * 基础数据库处理类
 * @version 1.0
 * @package db
 */
class db_mysql {
	/**
	 *
	 * @var mysqlilink $conn 数据库连接源
	 */
	public $conn;
	/**
	 *
	 * @static
	 *
	 * @var db_mysql $_handle 静态的db_mysql类实体
	 */
	private static $_handle = null;
	/**
	 * 私有化的构造函数，禁止外部创建，实现单例模式
	 * @param string $dbhost mysql数据库地址
	 * @param string $dbuser 数据库用户名
	 * @param string $dbpw   数据库连接密码
	 * @param string $dbname 数据库名称
	 * @param string $dbcharset 数据库字符集
	 * @return db_mysql
	 */
	private function __construct($dbhost, $dbuser, $dbpw, $dbname = '', $dbcharset = '') {
		if(!$this->conn = mysqli_connect ( $dbhost, $dbuser, $dbpw, $dbname )) die("数据库链接错误");
		
		$this->query ( 'set names utf8' );
	}
	/**
	 * 猎取类实例
	 * @return db_mysql
	 */
	public static function getInstance() {
		if (self::$_handle) {
			$handle = self::$_handle;
		} else {
			$handle = self::$_handle = new self ( HOST, USER, PWD, DBNAME );
		}
		return $handle;
	}
	/**
	 * 析构函数据，释放数据库连接
	 */
	function __destruct() {
		mysqli_close ( $this->conn );
	}
	/**
	 * 删除数据
	 * @param string $table 要删除数据的表名
	 * @param string $condition 删除数据的条件
	 * @return boolen 是否执行成功标志
	 */
	public function delete($table, $condition = "") {
		if (empty( $condition )) {
			$this->halt ( '没有设置删除的条件' );
			return false;
		}
		$sql = "delete from " . $table;
		if ($condition != '') {
            if (strpos(strtolower($condition), 'where') === false) {
                $sql .= ' where ';
            }
			$sql .= $condition;
		}
		if (! $this->query ( $sql )) {
			return false;
		} else {
			return true;
		} // if
	}
	/**
	 * 更新数据
	 * @param string $table 要更新数据的表名
	 * @param array $dataArray 更新的数据
	 * 			格式如下 [列名=>值,列名=>值,.....]
	 * @param $condition 条件
	 * @return boolen 是否执行成功标志
	 */
	public function update($table, $dataArray, $condition = "") {
		if (! is_array ( $dataArray ) || (count ( $dataArray ) <= 0)) {
			$this->halt ( '没有要更新的数据' );
			return false;
		}
		$value = "";
		while ( list ( $key, $val ) = each ( $dataArray ) ) {
			$value .= "`$key` = '" .addslashes($val)  . "',";
		}
		$value = substr ( $value, 0, - 1 );
		$sql = "UPDATE " . $table . " SET " . $value;
		if ($condition != '') {
			$sql .= $condition;
		}
		if (! $this->query ( $sql )) {
			return false;
		} else {
			return true;
		}
	}
	/**
	 * 添加数据
	 * @param string $table 要添加数据的表名
	 * @param array $dataArray 添加的数据
	 * 			格式如下 [列名=>值,列名=>值,.....]
	 * 
	 * @return mix 是否执行成功标志或插入数据的 insert_id
	 */
	public function insert($table, $dataArray) {
		$field = "";
		$value = "";
		if (! is_array ( $dataArray ) || (count ( $dataArray ) <= 0)) {
			$this->halt ( '没有要增加的数据' );
			return false;
		}
		foreach  ( $dataArray as $key=>$val) {
			$field .= "`$key`,";
			$value .= "'".addslashes(htmlspecialchars($val))."',";
		}
		$field = substr ( $field, 0, - 1 );
		$value = substr ( $value, 0, - 1 );
		$sql = "INSERT INTO " . $table . " (" . $field . ") values (" . $value . " )";
		if (! $this->query ( $sql )) {
			return false;
		} else {
			return $this->conn->insert_id;
		}
	}
	/**
	 * 取出单条数据
	 * @param string $sql 数据库查询的语句
	 * @return array 数据内容
	 */
	public function getOne($sql, $resultType = MYSQL_ASSOC) {
		$q = $this->query ( $sql );
		$rt=array();
		$r = $q->fetch_array ( $resultType );
			foreach ($r as $key=>$s)
			{
				$rt[$key]=stripcslashes($s);
			}
		return $rt;
	}
	/**
	 * 取出多条数据
	 * @param string $sql 数据库查询的语句
	 * @return array 数据内容
	 */
	public function getAll($sql) {
		$q = $this->query ( $sql );
		$rt=array();
		while ( $r = $q->fetch_array ( MYSQL_ASSOC ) ) {
			foreach ($r as $key=>$s)
			{
				$rr[$key]=stripcslashes($s);
			}	
				
			$rt [] = $rr;
		}
		return $rt;
	}
	/**
	 * 错误执行挂起操作
	 * @param string $msg 中断挂 起显示的信息
	 * @return void
	 */
	private function halt($msg = '') {
		$msg .= "\r\n" . $this->conn->error;
		die ( $msg );
	}

	/**
	 * 取得查询中第一行第一列的值getCol的别名
	 *  @param string $msg 中断挂 起显示的信息
	 * 	@return mixed 
	 */
	public function result_first($sql) {
		return $this->getCol($sql);
	}
	/**
	 * 取得查询中第一行第一列的值
	 *  @param string $msg 中断挂 起显示的信息
	 * 	@return mixed
	 */
	public function getCol($sql) {
		$rt = $this->getOne ( $sql );
		$jg = array_values ( $rt );
		return $jg [0];
	}
	/**
	 * 执行数据库查询
	 * @param string $sql 查询语句
	 * @return mixed 查询是否成功或挂 起
	 */
	public function query($sql) {
 		//echo  $sql.'<br>';
		if ($res = $this->conn->query ( $sql )) {
			return $res;
		} else {
			global $param;
			$errno=$this->conn->errno;
			$errinfo=$this->conn->error;
			$data['error_type']="mysql";
			$data['controller']=$param["controller"];
			$data['action']=$param["action"];
			$data['error_no']=$errno;
			$data['error_info']=addslashes($errinfo);			
			$data['time']=time();
			$data['sqlstr']=addslashes($sql);
			$data['uid']=$_SESSION['user']['employee_id'];
			$this->insert('sop_data_error',$data);
			
			if (defined ( 'DBDEBUG' ) && DBDEBUG == 1) {
				$this->halt ( '<pre>数据库错误:' . $sql . '
	错误编号:' . $errno . '
	错误信息:' . $errinfo );
			} else {
				return false;
			}
		}
	}
	/**
	 * 受影响的行数
	 * @return int
	 */
	public function  affected_rows()
	{
		return $this->conn->num_rows;
	
	}
	/**
	 * 读取结果集中的数据
	 * @param mysqli_result $res
	 * @return array
	 */
	public  function fetch_array($res)
	{
		 $r=$res->fetch_array ( MYSQL_ASSOC );
		foreach ($r as $key=>$s)
		{
			$rr[$key]=stripcslashes($s);
		}
		return $rr;
	}
	/**
	 * 为保持原有功能，为getOne增加别名
	 * @param string $sql 查询的SQL语句
	 * @return array
	 */
	public function fetch_first($sql)
	{
		return $this->getOne($sql);
	}
}
?>