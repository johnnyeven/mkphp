<?php
/**
 * CCloudService class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 namespace mkphp\service;
 
 use mkphp\core\CModel;
 use \Exception;
 
 /**
 * 
 *
 */
 class CCloudService extends CModel{
 
	/**
	 *
	 */
	public function __call($name,$arguments) {
		if(empty($arguments)||count($arguments)<=0)
			throw new Execption("empty arguments from service mothed:".$name,500);
		$arg = $arguments[0];
		$value = is_int($arg)?$arg:is_string($arg)?crc32($arg):null;
		if(isset($value)){
			$services=$this->_c;
			foreach($services as $v=>$s){
				if($v<$value)
					continue;
				$service = $s;
			}
			if(!isset($service)&&reset($services)){
				$service = key($services);
			}
			if(isset($service)&&$service)
				$this->$service->$name($arguments);
		}
		throw new Execption("empty value from service mothed:".$name,500);
	}
 }