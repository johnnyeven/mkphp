<?php
/**
 * CControllerRouter class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 
 namespace mkphp\web;

 use \Exception;
 /**
  *
  */
 class CControllerRouter implements IRouter{

	/**
	 *
	 */
	Const Info='PATH_INFO';
	Const Split='/';
	Const Controller = 'controller';
	Const Action = 'action';
	Const NS = 'ns';
	
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
	public function route($request){
		$server = $request->Server;
		if(isset($server[self::Info])){
			$params = explode(self::Split,$server[self::Info]);
			if(is_array($params)&&!empty($params)){
				if(count($params)==4)
					return array(self::NS=>$params[1],self::Controller=>$params[2],self::Action=>$params[3]);
				if(count($params)==3)
					return array(self::Controller=>$params[1],self::Action=>$params[2]);
				if(count($params)==2)
					return array(self::Controller=>$params[1],self::Action=>null);
			}
			throw new Exception(get_class($this).'can not be route "'.$server[self::Info].'"',404);
		}
		throw new Exception(get_class($this).'can not be route empty path',404);
	}
 }
