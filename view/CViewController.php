<?php
/**
 * CViewController class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 namespace mkphp\view;

 use mkphp\service\CController;
 /**
  *
  */
 abstract class CViewController extends CController implements IViewProvider{
	
	/**
	 *
	 */
	private $_v;
	Const Name='View';
	
	/**
	 *
	 */
	public function __construct($provider){
		parent::__construct($provider);
		$name = self::Name;
	    if(isset($provider->$name))
			$this->_v = $provider->$name;
	}
	
	/**
	 *
	 */
	public function render($view,$model=null,$is_hack=false,$content=null){
		$provider = $this->_v;
		return $provider->render($view,$model,$content);
	}
 }
