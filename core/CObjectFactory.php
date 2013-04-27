<?php
/**
 * CObjectFactory interface file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 namespace mkphp\core;

 use \ReflectionClass;
 /**
 * 
 */
 class CObjectFactory implements IObjectFactory{
	
	private $className;
	private $paramsName;
	private $invokeName;
	private $modeName;
	
	/**
	 * newInstance
	 */
	public function newInstance($config){
		if(!is_array($config)||!isset($config[$this->className]))
			return $config;
		
		$params = isset($config[$this->paramsName])?$config[$this->paramsName]:null;
		
		if(isset($config[$this->modeName])&&$config[$this->modeName]){
			if(isset($config[$this->invokeName]))
				$object = call_user_func_array(array($config[$this->className],$config[$this->invokeName]),$params);
			else
				$object = (new ReflectionClass($config[$this->className]))->newInstanceArgs($params);
		}else{
			if(isset($config[$this->invokeName]))
				$object = call_user_func(array($config[$this->className],$config[$this->invokeName]),$params);
			else
				$object = new $config[$this->className]($params);
		}
		if(isset($object)&&$object instanceof CModel)
			$object->of = $this;
		return $object;
	}
	
	public function __construct($invokeName,$className,$paramsName,$modeName){
		$this->className = $className;
		$this->invokeName = $invokeName;
		$this->paramsName = $paramsName;
		$this->modeName = $modeName;
	}
 }
