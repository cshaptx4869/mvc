<?php
//通过表名获得Model类的对象
function M($tableName=NULL)
{
	include_once 'application/admin/core/Model.class.php';
	$model = new Model();
	$model->tableName = $tableName;
	return $model;
}
//通过模型名，获得模型对象
function D($modelName)
{
	$modelName .= "Model";
	include_once 'application/admin/model/'.$modelName.'.class.php';
	$model = new $modelName();
	return $model;
}

//控制器的父类
class Controller
{
	private $smarty = NULL;
	
	//初始化Smarty(在入口文件中实例化子类时，该构造被调用)
	public function __construct()
	{
		include 'application/admin/configs/config.php';
		include_once 'library/smarty/Smarty.class.php';
		$this->smarty = new Smarty();
		$this->smarty->setConfigDir($config["smarty"]["configDir"]);
		$this->smarty->setCompileDir($config["smarty"]["compileDir"]);
		$this->smarty->setCacheDir($config["smarty"]["cacheDir"]);
		$this->smarty->setTemplateDir("{$config["smarty"]["templateDir"]}/".CONTROLLER);
		$this->smarty->caching = $config["smarty"]["caching"];
		$this->smarty->cache_lifetime = $config["smarty"]["cacheLifeTime"];
		$this->smarty->left_delimiter = $config["smarty"]["leftDelimiter"];
		$this->smarty->right_delimiter = $config["smarty"]["rightDelimiter"];
		//向每个视图页面都传递这么两个常量值
		$this->smarty->assign("APP",APP);//入口文件地址
		$this->smarty->assign("ROOT",ROOT);//项目根目录地址
	}
	//显示指定的html页面
	public function display($tpl=ACTION)
	{
		$tpl .= ".html";
		$this->smarty->display($tpl);
	}
	//向html页面传递数据
	public function assign($key,$value=NULL)
	{
		$this->smarty->assign($key,$value);
	}
	//页面重定向(跳转页面)
	public function redirect($url)
	{
		header("location:{$url}");
	}
	//系统提示信息
	public function success($message,$jumpUrl)
	{
		include 'application/admin/configs/config.php';
		//临时变更默认的模板目录
		$this->smarty->setTemplateDir($config["web"]["success"]);
		//向success页面传递数据
		$this->smarty->assign("message",$message);
		$this->smarty->assign("jumpUrl",$jumpUrl);
		//显示success页面
		$this->smarty->display("success.html");
	}
}









