<?php
/**
 * CBase class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
namespace mkphp\core;

use \Exception;
 /**
 * CBase is the base class providing the common features needed by objects.
 *
 */
abstract class CBase{
	/**
	 *
	 */
	abstract protected function _get($name);
	abstract protected function _set($name,$value);
	
	/**
	 * 
	 */
	const Get='get';
	const Set='set';
	
	/**
	 * 
	 */
	public function __get($name){
		$getter=self::Get.$name;
		if(method_exists($this,$getter))
			return $this->$getter();
		return $this->_get($name);
	}
	
	/**
	 * 
	 */
	public function __set($name,$value){
		$setter=self::Set.$name;
		if(method_exists($this,$setter))
			return $this->$setter($value);
		return $this->_set($name,$value);
	}
	
	/**
	 * 
	 */
	public function __isset($name){
		$getter=self::Get.$name;
		if(method_exists($this,$getter))
			return $this->$getter()!==null;
		return $this->_get($name)!==null;
	}
	
	/**
	 * 
	 */
	public function __unset($name){
		$setter=self::Set.$name;
		if(method_exists($this,$setter))
			$this->$setter(null);
		$this->_set($name,$value);
		if(method_exists($this,self::Get.$name))
			throw new Exception('Property "'.get_class($this).'.'.$name.'" is read only.',500);
	}
}