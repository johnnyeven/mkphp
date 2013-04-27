<?php
/**
 * CMethodRouter class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 namespace mkphp\web;

 use mkphp\core\CModel;
 /**
  *
  */
 class CMethodRouter extends CModel implements IRouter{

	/**
	 *
	 */
	Const Action = 'action';
	Const Method ='REQUEST_METHOD';
 
	/**
	 *
	 */
	public function route($request){
		$route = $this->router->route($request);
		$route[self::Action] = $request->Server[self::Method];
		return $route;
	}
 }
