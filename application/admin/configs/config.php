<?php
//全局配置文件
$config = array(
	
	//常规配置信息
	"web"=>array(
		"defaultController"	=>"Index",//默认控制器
		"defaultAction"		=>"index",//默认方法
		"urlModel"			=>1,//url路由：0url传参  1pathinfo
		"app"				=>"/bbs/admin.php",//入口文件地址
		"root"				=>"/bbs",//项目根目录
		"urlSuffix"			=>".html",//伪静态后缀
		"success"			=>"application/admin/core",//success的存储位置
	),
	
	//数据库配置信息
	"db"=>array(
		"host"				=>"localhost",//主机地址
		"dbname"			=>"test",//库名
		"user"				=>"root",//用户名
		"password"			=>"root",//密码
	),
		
	//smarty模板引擎的配置信息
	"smarty"=>array(
		"configDir"			=>"application/admin/configs",//配置文件目录
		"templateDir"		=>"application/admin/view",//模板目录
		"cacheDir"			=>"application/admin/runtime/cache",//缓存目录
		"compileDir"		=>"application/admin/runtime/templates_c",//编译目录
		"caching"			=>false,//是否开启缓存
		"cacheLifeTime"		=>3600,//缓存时间
		"leftDelimiter"		=>"{",//标签左定界符
		"rightDelimiter"	=>"}",//标签右定界符
	),
);



