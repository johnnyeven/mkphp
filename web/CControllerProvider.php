<?php

/**
 * CControllerProvider class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */

 namespace mkphp\web;
 
 use \Exception;
 use mkphp\core\CModel;

 /**
  *
  */
 class CControllerProvider extends CModel implements IControllerProvider{
	/**
	 *
	 */
	private $_map=array();
	
	/**
	 *
	 */
	public function run($name,$action,$model=null){
		if(empty($action))
			throw new Exception("empty action with controller:".$name,404);
		
		if(isset($this->_map[$name]))
			return $this->runAction($this->_map[$name],$action,$model);
		if(class_exists($name)){
			$controller=$this->_map[$name]=new $name($this);
			return $this->runAction($controller,$action,$model);
		}
		throw new Exception("not found controller:".$name,404);
	}
	
	/**
	 *
	 */
	private function runAction($controller,$action,$model){
		if(method_exists($controller,$action))
			return $controller->$action($model);
		throw new Exception("not found action:".$action,501);
	}
 }
