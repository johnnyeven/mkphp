<?php
 /**
 * Runtime class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */

 namespace mkphp;
 
 use \Exception;
 use mkphp\core\IHandler;
 use mkphp\core\IObjectFactory;
 use mkphp\core\CObjectFactory;
 use mkphp\core\CModel;
 
 class Runtime{
	
	/**
	 *
	 */
	const RUNTIME='Runtime';
	
	const ClassName='class';
	const ParamsName='params';
	const InvokeName='invoke';
	const ModeName='mode';
	const AutoLoad='autoload';
	const NS='\\';
	
	private $_cm=array();
	private $_paths=array();
	private $_c=array();
	private $_l=array();
	private $_exts=array();
	private $_h;
	
	/**
	 *
	 */
	public function run(){
		if(!isset($this->_h)){
			$this->_h = $this->of->newInstance($this->_c);
			if(!($this->_h Instanceof IHandler))
				throw new Exception('app is not implements by IHandler');
		}
		$this->_h->execute();
	}
	
	/**
	 *
	 */
	public function __construct($main,$paths,$exts,$classMap=null){
		$this->_c=array_merge($this->_c,$main);
		$this->_paths=array_merge($this->_paths,$paths);
		$this->_exts=array_merge($this->_exts,$exts);
		$this->_cm=array_merge($this->_cm,$classMap);
		$this->setloader(self::RUNTIME,array($this,self::AutoLoad));
		$this->of = new CObjectFactory(self::InvokeName,self::ClassName,self::ParamsName,self::ModeName);
	}
 
 	/**
	 *
	 */
	public function getloader(){
		return self::RUNTIME;
	}
 
	/**
	 *
	 */
	public function setloader($name,$callback)
	{
		foreach($this->_l as $n=>$c){
			spl_autoload_unregister($c);	
		}
		$this->_l[$name]= $callback;
		asort($this->_l[$name]);
		foreach($this->_l as $n=>$c){
			spl_autoload_register($c);	
		}
	}
	
	/**
	 *
	 */
	public function unsetloader($name)
	{
		spl_autoload_unregister($this->_l[$name]);
		unset($this->_l[$name]);
	}
 
	/**
	 *
	 */
	public function autoload($className){
		if(isset($this->_cm[$className]))
			$classFile = $this->_cm[$className];
		else{
			if(strpos($className,self::NS)==false)
				$classFile = $this->_cm[$className] = $this->findFile($className);
			else{
				$parts = explode(self::NS,$className);
				$fileName = str_replace(self::NS,DIRECTORY_SEPARATOR,$className);
				$classFile = $this->_cm[$className] = $this->findFile($fileName,$parts[0]);
			}
		}
		if(empty($classFile))
			return false;
		include($classFile);
		return class_exists($className,false) || interface_exists($className,false);
	}
	
	/**
	 * 
	 */
	public function find($name){
		if(empty($name))
			return null;
		foreach($this->_exts as $ext){
			$script = isset($ext)?$name.$ext:$name;
			if(is_file($script))
				return $script;
		}
		return null;
	}
	
	/**
	 * 
	 */
	public function findFile($fileName,$part=''){
		if(empty($fileName))
			return;
		if($part==__NAMESPACE__)
			return $this->find(dirname(__DIR__).DIRECTORY_SEPARATOR.$fileName);
		$paths = isset($this->_paths[$part])?$this->_paths[$part]:isset($this->_paths[''])?$this->_paths['']:dirname(__DIR__);
		if(is_array($paths))
			foreach($paths as $path){
				$file= $this->find($path.DIRECTORY_SEPARATOR.$fileName);
				if(isset($file))
					return $file;
			}
		else if(is_string($paths))
			return $this->find($paths.DIRECTORY_SEPARATOR.$fileName);
			
		return null;
	}
 }
