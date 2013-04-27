<?php
/**
 * CHandler class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 namespace mkphp\web;

 use mkphp\core\CModel;
 use mkphp\core\IHandler;
 /**
  *
  */
 class CHandler extends CModel implements IHandler{
	
	/**
	 *
	 */
	Const Controller = 'controller';
	Const Action = 'action';
	Const Model = 'model';
	
	/**
	 *
	 */
	public function execute($context){
		$c = $context[self::Controller];
		$a = $context[self::Action];
		$m = $context[self::Model];
		
		$this->provider->run($c,$a,$m);
	}
 }
