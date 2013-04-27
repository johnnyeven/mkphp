<?php
/**
 * IObjectFactory interface file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 namespace mkphp\core;

 /**
 * 
 */
 interface IObjectFactory{
 
	/**
	 * newInstance
	 */
	public function newInstance($config);
 }
