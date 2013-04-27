<?php
/**
 * CJsonSerializer class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */

 namespace mkphp\data;

 use \Exception;
 /**
  *
  */
 class CJsonSerializer implements ISerializer{
 
 	/**
	 *
	 */
	private static $_s;
 
 	/**
	 *
	 */
	public function serialize($mixed){
		return isset($mixed)?json_encode($mixed):null;
	}
	
	/**
	 *
	 */
	public function unserialize($data){
		return json_decode($data);
	}
	
	/**
	 *
	 */
	public static function newInstance(){
		if(!isset(self::$_s)){
			$c=__CLASS__;
			self::$_s=new $c;
		}
		return self::$_s;
	}
	
	/**
	 *
	 */
	public function __clone(){
		throw new Exception(get_class($this).'can not be Clone.',500);
	}
	
 }
