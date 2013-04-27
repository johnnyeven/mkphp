<?php
/**
 * CFactoryRouter class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 namespace mkphp\web;

 use mkphp\core\CArrayModel;
 /**
  *
  */
 class CFactoryRouter extends CArrayModel implements IRouter{
 
	/**
	 *
	 */
	public function route($request){
		foreach($this as $router){
			$context = $router->route($request);
			if(!empty($context))
				break;
		}
		return $context;
	}
 }
