<?php
/**
 * CHttpRequest class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 namespace mkphp\web;

 use mkphp\core\CBase;
 use \Exception;
 /**
  *
  */
 class CHttpRequest extends CBase implements IHttpRequest{
	
	/**
	 *
	 */
	Const Body='php://input';


	/**
	 *
	 */
	private static $_s;
	
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

	/**
	 *
	 */
	protected function _get($name){
		throw new Exception('Property "'.get_class($this).'.'.$name.'" can not be found.',500);
	}
	
	/**
	 *
	 */
	protected function _set($name,$value){
		throw new Exception('Property "'.get_class($this).'.'.$name.'" can not be set.',500);
	}
	
	/**
	 *
	 */
	public function getServer(){
		return $_SERVER;
	}
	
	/**
	 *
	 */
	public function getCookie(){
		return $_COOKIE;
	}
	
	/**
	 *
	 */
	public function getGet(){
		return $_GET;
	}
	
	/**
	 *
	 */
	public function getPost(){
		return $_POST;
	}
	
	/**
	 *
	 */
	public function getFiles(){
		return $_FILES;
	}
	
	/**
	 *
	 */
	public function getSession(){
		return $_SESSION;
	}
	
	/**
	 *
	 */
	public function getBody(){
		return file_get_contents(self::Body);
	}
 }
