<?php
header("content-type:text/html;charset=utf-8");
include_once 'application/admin/core/Controller.class.php';//控制器的父类
include_once 'application/admin/core/Model.class.php';//模型的父类
include 'application/admin/configs/config.php';//配置文件

//定义系统常量
define("APP",$config["web"]["app"]);//入口文件地址
define("ROOT",$config["web"]["root"]);//项目根目录

$urlModel = $config["web"]["urlModel"];//url路由  0:url传参    1:pathinfo方式

if($urlModel == 1)
{
	//获得当前url地址
	//  /bbs/index.php/Login/index.html
	$url = $_SERVER["REQUEST_URI"];
	$url = str_replace($config["web"]["urlSuffix"],"",$url);
	//分割url地址
	$arr = explode("/",$url);
	//获得$arr中入口文件的下标
	$index = array_search("admin.php",$arr);
	//获得控制器和方法
	if($index)
	{
		$c = isset($arr[$index+1])?$arr[$index+1]:$config["web"]["defaultController"];
		$a = isset($arr[$index+2])?$arr[$index+2]:$config["web"]["defaultAction"];
		//代表url中有参数
		if(isset($arr[$index+3]))
		{
			//遍历数组，获得所有的url参数
			for($i=$index+3;$i<count($arr)-1;$i+=2)
			{
				$key = $arr[$i];//参数名
				$value = $arr[$i+1];//参数值
				//将获得出来的参数，存放到$_GET中
				$_GET[$key] = $value;
			}
		}
	}
	else
	{
		//url中没有填写index.php，设置默认控制器、方法
		$c = $config["web"]["defaultController"];
		$a = $config["web"]["defaultAction"];
	}
}
else
{
	$c = isset($_GET["c"])?$_GET["c"]:$config["web"]["defaultController"];//控制器名
	$a = isset($_GET["a"])?$_GET["a"]:$config["web"]["defaultAction"];//方法名
}


//定义系统常量
define("CONTROLLER",$c);
define("ACTION",$a);

//补全控制器名和方法名
$c .= "Controller";
$a .= "Action";

include_once 'application/admin/controller/'.$c.'.class.php';
$controller = new $c();
$controller->$a();

