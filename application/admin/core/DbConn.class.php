<?php
//数据库封装类
class DbConn
{
	private $conn;//连接对象
	
	//连接数据库(私有的构造：防止实例化)
	private function __construct()
	{
		include 'application/admin/configs/config.php';
		
		$url = "mysql:host={$config["db"]["host"]};dbname={$config["db"]["dbname"]}";
		$user = $config["db"]["user"];
		$pwd = $config["db"]["password"];
		$this->conn = new PDO($url,$user,$pwd);
	}
	//防止克隆对象
	private function __clone()
	{}
	//利用单例，获得该类的对象
	public static function getInstance()
	{
		static $obj = NULL;
		if($obj == NULL)
		{
			$obj = new DbConn();
		}
		return $obj;
	}
	//执行select语句，返回：二维数组
	public function queryAll($sql)
	{
		$st = $this->conn->query($sql);
		$rs = $st->fetchAll();
		return $rs;
	}
	//执行select语句，返回：一维关联数组
	public function queryOne($sql)
	{
		$st = $this->conn->query($sql);
		$rs = $st->fetch();
		return $rs;
	}
	//执行增删改语句，返回：受影响的行数
	public function execute($sql)
	{
		$result = $this->conn->exec($sql);
		return $result;
	}
}