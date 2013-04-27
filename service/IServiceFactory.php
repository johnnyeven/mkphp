<?php
/**
 * IServiceFactory interface file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */

 namespace mkphp\service;

 /**
 * 
 *
 */
 interface IServiceFactory{
	public function createService($name);
 }
