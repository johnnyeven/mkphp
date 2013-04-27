<?php
/**
 * CModel class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */

 namespace mkphp\core;

 class CModel extends CBase implements IObjectFactory{
	
	/**
	 *
	 */
	private $_c;
	private $_m = array();
	private $_f;
	
	/**
	 *
	 */
	protected function _get($name){
		if(isset($this->_m[$name]))
			return $this->_m[$name];
		if(!isset($this->_c))
			return null;
		$c = $this->_c;
		if(is_array($c)&&isset($c[$name]))
			return $this->_m[$name] = $this->newInstance($c[$name]);
		if(is_object($c)&&isset($c->$name))
			return $this->_m[$name] =$this->newInstance($c->$name);
		return null;
	}
	
	/**
	 *
	 */
	protected function _set($name,$value){
		return $this->_m[$name] = $value;
	}
	
	/**
	 * newInstance
	 */
	public function newInstance($config){
		if(isset($this->of)&& $this->of instanceof IObjectFactory)
			return $this->of->newInstance($config);
		return $config;
	}
	
	/**
	 *
	 */
	public function __construct($data){
		$this->_c=isset($data)?$data:null;
	}
 }