<?php
/**
 * CContextFactory class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 namespace mkphp\web;

 use mkphp\core\CModel;
 /**
  *
  */
 class CContextFactory extends CModel implements IContextFactory{
 
	/**
	 *
	 */
	public function createContext($request){
		$route = $this->createRoute($request);
		if(empty($route))
			return $route;
		$data = $this->createData($request);
		return is_array($route)?array_merge($route,$data):null;
	}

	/**
	 *
	 */
	private function createRoute($request){
		return $this->router->route($request);
	}

	/**
	 *
	 */
	private function createData($request){
		return $this->binder->bind($request);
	}
}
