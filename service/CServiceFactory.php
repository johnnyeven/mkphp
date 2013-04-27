<?php

/**
 * CServiceFactory class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */

 namespace mkphp\service;
 
 use \Exception;
 use mkphp\core\CModel;
 /**
  *
  */
 class CServiceFactory extends CModel implements IServiceFactory{
	
	/**
	 *
	 */
	public function createService($name){
		if(isset($this->$name)){
			return $this->$name;
		}
		throw new Exception("not found service:".$name,500);
	}
 }
