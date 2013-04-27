<?php
/**
 * CDictionaryRouter class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 namespace mkphp\web;
 
 use mkphp\core\CModel;
 /**
  *
  */
 class CDictionaryRouter implements IRouter{

	/**
	 *
	 */
	Const Path='';
	Const Info='PATH_INFO';
	
	private $d;
 
	/**
	 *
	 */
	public function route($request){
		$server = $request->Server;
		$path = isset($server[self::Info])?$server[self::Info]:self::Path;
		return isset($this->d)&&isset($this->d[$path])?$this->d[$path]:null;
	}
	
	/**
	 *
	 */
	public function __construct($data){
		$this->d=isset($data)?$data:null;
	}
 }
