<?php
/**
 * IControllerProvider interface file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 
 namespace mkphp\web;

 /**
  * 
  *
  */
 interface IControllerProvider{
	public function run($name,$action,$model=null);
 }
