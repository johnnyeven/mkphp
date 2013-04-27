<?php
/**
 * CServiceHandler class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 namespace mkphp\web;
 
 use mkphp\core\CModel;
 use mkphp\core\IHandler;
 use mkphp\data\ISerializer;
 use \Exception;

 /**
  *
  */
 class CServiceHandler extends CModel implements IHandler{
	
	/**
	 *
	 */
	Const Controller = 'controller';
	Const Action = 'action';
	Const Model = 'model';
	Const Type = 'type';
	Const Header = 'Content-type: %s;';
	
	/**
	 *
	 */
	public function execute($context){
		$c = $context[self::Controller];
		$a = $context[self::Action];
		$m = $context[self::Model];
		$t = $context[self::Type];
		
		$model =$this->provider->run($c,$a,$m);
		$this->render($t,$model);
	}
	
	/**
	 *
	 */
	private function render($type,$model){
		$s = $this->serializers;
		if(isset($s->$type)&&$s->$type instanceof ISerializer){
			$h = isset($this->Header)?$this->Header:self::Header;
			header(sprintf($h,$type));
			echo $s->$type->serialize($model);
			return;
		}
		throw new Exception('not support '.$type.' serializer',501);
	}
 }
