<?php
/**
 * CFilterBinder class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 namespace mkphp\web;

 use mkphp\core\CModel;
 use mkphp\data\ISerializer;
 /**
  *
  */
 class CFilterBinder extends CModel implements IBinder{

	/**
	 *
	 */
    Const Path='';
	Const Post='Post';
	Const ContentType='CONTENT_TYPE';
	Const DefaultContentType='application/x-www-form-urlencoded';
	Const DataContentType='multipart/form-data';
	Const Info='PATH_INFO';
	Const Type='type';
	Const Model = 'model';

	/**
	 *
	 */
	public function bind($request){
		$server = $request->Server;
		$path = isset($server[self::Info])?$server[self::Info]:self::Path;
		$strategys = $this->Strategys;
		$strategy = isset($strategys[$path])?$strategys[$path]:$strategys[self::Path];
		
		$model;
		if(isset($strategy)&&is_array($strategy))
			$model =$this->bindArrayStrategy($server,$strategy,$request);
		else
			$model = $this->bindStrategy($server,$strategy,$request);
		return $this->bindData($server,$model);
	}
	
	/**
	 *
	 */
	private function bindData($server,$model){
		return array(self::Model=>$model,self::Type=>(isset($server[self::ContentType])?$server[self::ContentType]:self::DefaultContentType));
	}
	
	/**
	 *
	 */
	private function bindArrayStrategy($server,$strategys,$request){
		$context = array();
		foreach($strategys as $strategy){
			$current=$this->bindStrategy($server,$strategy,$request);
			if(isset($current))
				if(is_array($current))
					$context =array_merge($context,$current);
				else
					foreach($current as $key=>$value)
						$context[$key]=$value;
		}
		return $context;
	}
	
	/**
	 *
	 */
	private function bindStrategy($server,$strategy,$request){
		if(!is_string($strategy))
			return null;
		if($strategy==self::Post)
			return $this->bindPostStrategy($server,$request);
		return $request->$strategy;
	}

	/**
	 *
	 */
	private function bindPostStrategy($server,$request){
		$ct = isset($server[self::ContentType])?$server[self::ContentType]:self::DefaultContentType;
		if($ct==self::DefaultContentType||$ct==self::DataContentType){
			$p = self::Post;
			return $request->$p;
		}
		$b = $request->Body;
		$s = $this->Serializers;
		return isset($s->$ct)&&$s->$ct instanceof ISerializer?$s->$ct->unserialize($b):null;
	}
 }
