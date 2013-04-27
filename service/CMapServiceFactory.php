<?php

/**
 * CDictionaryServiceFactory class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */

 namespace mkphp\service;
 
 use mkphp\core\CModel;
 /**
  *
  */
 class CMapServiceFactory extends CModel implements IServiceFactory{
 
	/**
	 *
	 */
	public function createService($name){
		if(!isset($this->factory))
			throw new Exception(__CLASS__." not found service factory");
		if(isset($this->map)&&isset($this->map[$name])){
			return $this->factory->createService($this->map[$name]);
		}
		throw new Exception("not found service:".$name,500);
	}
 }
