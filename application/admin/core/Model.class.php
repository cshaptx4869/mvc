<?php
include_once 'application/admin/core/DbConn.class.php';

//模型父类
class Model
{
	public $tableName = NULL;//表名
	public $join = NULL;//多表
	public $where = NULL;//条件
	public $order = NULL;//排序
	public $limit = NULL;//分页
	
	//设置join多表
	public function join($join)
	{
		$this->join = $join;
		return $this;
	}
	//设置where条件
	public function where($where)
	{
		$this->where = $where;
		return $this;//返回当前类的对象
	}
	//设置order排序
	public function order($order)
	{
		$this->order = $order;
		return $this;
	}
	//设置limit分页
	public function limit($offset,$pageSize)
	{
		$this->limit = "{$offset},{$pageSize}";
		return $this;
	}
	//查询多条记录，返回：二维数组
	public function select()
	{
		$sql = "select * from {$this->tableName}";
		if(isset($this->join))
		{
			$sql .= " inner join {$this->join}";
		}
		if(isset($this->where))
		{
			$sql .= " where {$this->where}";
		}
		if(isset($this->order))
		{
			$sql .= " order by {$this->order}";
		}
		if(isset($this->limit))
		{
			$sql .= " limit {$this->limit}";
		}
		
		$conn = DbConn::getInstance();
		$result = $conn->queryAll($sql);
		return $result;
	}
	//删除记录，返回：受影响的行数
	public function delete()
	{
		$sql = "delete from {$this->tableName}";
		if(isset($this->where))
		{
			$sql .= " where {$this->where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->execute($sql);
		return $result;
	}
	//添加记录，返回：受影响的行数
	public function insert($data)
	{
		$str1 = "";//字段名的字符串
		$str2 = "";//字段值的字符串
		foreach ($data as $k=>$v)
		{
			$str1 .= "{$k},";
			$str2 .= "'{$v}',";
		}
		$str1 = rtrim($str1,",");
		$str2 = rtrim($str2,",");
		$sql = "insert into {$this->tableName}({$str1})values({$str2})";
		$conn = DbConn::getInstance();
		$result = $conn->execute($sql);
		return $result;
	}
	//查询一条记录，返回：一维关联数组
	public function find()
	{
		$sql = "select * from {$this->tableName}";
		if(isset($this->join))
		{
			$sql .= " inner join {$this->join}";
		}
		if(isset($this->where))
		{
			$sql .= " where {$this->where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->queryOne($sql);
		return $result;
	}
	//修改记录，返回：受影响的行数
	public function update($data)
	{
		$str = "";
		foreach ($data as $k=>$v)
		{
			$str .= "{$k}='{$v}',";
		}
		$str = rtrim($str,",");
		$sql = "update {$this->tableName} set {$str}";
		if(isset($this->where))
		{
			$sql .= " where {$this->where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->execute($sql);
		return $result;
	}
	//count查询，返回：数字
	public function count()
	{
		$sql = "select count(*) from {$this->tableName}";
		if(isset($this->where))
		{
			$sql .= " where {$this->where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->queryOne($sql);
		return $result[0];
	}
	//sum查询，返回：数字
	public function sum($field)
	{
		$sql = "select sum({$field}) from {$this->tableName}";
		if(isset($this->where))
		{
			$sql .= " where {$this->where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->queryOne($sql);
		return $result[0];
	}
	//avg查询，返回：数字
	public function avg($field)
	{
		$sql = "select avg({$field}) from {$this->tableName}";
		if(isset($this->where))
		{
			$sql .= " where {$this->where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->queryOne($sql);
		return $result[0];
	}
	//max查询，返回：数字
	public function max($field)
	{
		$sql = "select max({$field}) from {$this->tableName}";
		if(isset($this->where))
		{
			$sql .= " where {$this->where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->queryOne($sql);
		return $result[0];
	}
	//min查询，返回：数字
	public function min($field)
	{
		$sql = "select min({$field}) from {$this->tableName}";
		if(isset($this->where))
		{
			$sql .= " where {$this->where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->queryOne($sql);
		return $result[0];
	}
	//执行select语句，返回：二维数组
	public function query($sql)
	{
		$conn = DbConn::getInstance();
		$result = $conn->queryAll($sql);
		return $result;
	}
	//执行增删改语句，返回：受影响的行数
	public function execute($sql)
	{
		$conn = DbConn::getInstance();
		$result = $conn->execute($sql);
		return $result;
	}
}


















