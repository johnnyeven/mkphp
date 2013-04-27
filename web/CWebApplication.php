<?php
/**
 * CWebApplication class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 namespace mkphp\web;

 use mkphp\core\CModel;
 use mkphp\core\IHandler;
 use \Exception;
 /**
 *
 *
 */

class CWebApplication extends CModel implements IHandler{
	
	/**
	 *
	 */
	Const Header = 'HTTP/1.1 %d %s';
	
	private static $_m=array(
		100=>'Continue'
		,101=>'Switching Protocols'
		,201=>'Created'
		,202=>'Accepted'
		,203=>'Non-Authoritative Information'
		,204=>'No Content'
		,205=>'Reset Content'
		,206=>'Partial Content'
		,300=>'Multiple Choices'
		,301=>'Moved Permanently'
		,302=>'Found'
		,303=>'See Other'
		,304=>'Not Modified'
		,305=>'Use Proxy'
		,306=>'(Unused)'
		,307=>'Temporary Redirect'
		,400=>'Bad Request'
		,401=>'Unauthorized'
		,402=>'Payment Required'
		,403=>'Forbidden'
		,404=>'Not Found'
		,405=>'Method Not Allowed'
		,406=>'Not Acceptable'
		,407=>'Proxy Authentication Required'
		,408=>'Request Timeout'
		,409=>'Conflict'
		,410=>'Gone'
		,411=>'Length Required'
		,412=>'Precondition Failed'
		,413=>'Request Entity Too Large'
		,414=>'Request-URI Too Long'
		,415=>'Unsupported Media Type'
		,416=>'Requested Range Not Satisfiable'
		,417=>'Expectation Failed'
		,500=>'Internal Server Error'
		,501=>'Not Implemented'
		,502=>'Bad Gateway'
		,503=>'Service Unavailable'
		,504=>'Gateway Timeout'
		,505=>'HTTP Version Not Supported'
	);
	
	/**
	 *
	 */
	protected function onException($sender,$e){
		$exception = isset($this->exception)&&$this->exception instanceof IContextFactory?$this->exception:null;
		if(isset($exception)){
			$context = $this->exception->createContext($e);
		}
		if(isset($context)){
			try{
				$this->executeHandle($context);
			}catch(Exception $ex){
				$this->onDefaultException($e);
			}
			return;
		}
		$this->onDefaultException($e);
	}
	
	private function onDefaultException($e){
		$code = $e->getCode();
		if(isset(self::$_m[$code])){
			header(sprintf(self::Header,$code,self::$_m[$code]));
		}
		if(isset($this->log)&&($code==500||!isset(self::$_m[$code]))){
			$this->log->error(isset(self::$_m[$code])?self::$_m[$code]:$code,$e);
		}
	}
	
	/**
	 *
	 */
	public function execute($context=null){
		try{
			$context=$this->createContext();
			if(empty($context))
				throw new Exception('Empty Context',404);
			
			$this->executeHandle($context);
		}catch(Exception $e){
			$this->onException($this,$e);
		}
	}

	/**
	 *
	 */
	private function createContext(){
		$request=$this->request;
		$factory=$this->factory;
		if(isset($request)&&isset($factory)&&$request instanceof IHttpRequest&&$factory instanceof IContextFactory)
			return $factory->createContext($request);
		return null;
		
	}

	/**
	 *
	 */
	private function executeHandle($context){
		$handler=$this->handler;
		if(empty($handler))
			throw new Exception('Empty Handler',500);
		
		$handler->execute($context);
	}
}
