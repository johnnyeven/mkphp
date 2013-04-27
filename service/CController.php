<?php
/**
 * CController class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 
 namespace mkphp\service;
 use mkphp\core\CModel;

 /**
  *
  */
 abstract class CController implements IServiceFactory{
	
	/**
	 *
	 */
	private $_s;
	Const Name='Service';
	
	/**
	 *
	 */
	public function __construct($provider){
		$name = self::Name;
	    if(isset($provider->$name))
			$this->_s = $provider->$name;
	}

	/**
	 *
	 */
	public function createService($name){
		$provider = $this->_s;
		return $provider->createService($name);
	}
	
 }
