<?php
/**
 * IContextFactory interface file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */

 namespace mkphp\web;

 /**
 * 
 *
 */
 interface IContextFactory{
	public function createContext($request);
 }
