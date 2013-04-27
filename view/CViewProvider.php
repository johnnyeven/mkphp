<?php

/**
 * CViewProvider class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 
 namespace mkphp\view;

 use \Exception;
 /**
  *
  */
 class CViewProvider implements IViewProvider{
	
	/**
	 *
	 */
	private $_paths;
	private $_exts;

	Const Paths='Paths';
	Const Exts='Exts';
	
	/**
	 *
	 */
	public function render($view,$model=null,$is_hack=false,$content=null){
		$_view= $this->findView($view);
		
		if(empty($_view))
			throw new Exception("not found view:".$view,500);
		return $this->renderView($_view,$model,$is_hack,$content);
	}
	
	/**
	 *
	 */
	private function renderView($view,$model,$is_hack,$content){
		if($is_hack){
			ob_start();
			ob_implicit_flush(false);
			require($view);
			return ob_get_clean();
		}
		require($view);
	}
	
	/**
	 *
	 */
	private function findView($view){
		if(empty($this->_exts)||empty($view))
			return null;
		foreach($this->_exts as $ext){
			$_view=$this->findViewFile($view.$ext);
			if(!empty($_view))
				return $_view;
		}
		return null;
	}
	
	/**
	 *
	 */
	private function findViewFile($view){
		if(empty($this->_paths)||empty($view))
			return null;
		foreach($this->_paths as $path){
			$_view=$path.DIRECTORY_SEPARATOR.$view;
			if(is_file($_view))
				return $_view;
		}
		return null;
	}

	/**
	 *
	 */
	public function __construct($params){
		if(isset($params[self::Paths]))
			$this->_paths = $params[self::Paths];
		if(isset($params[self::Exts]))
			$this->_exts = $params[self::Exts];
	}
 }
