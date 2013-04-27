<?php
/**
 * IViewProvider interface file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */

 namespace mkphp\view;

 /**
 * 
 *
 */
 interface IViewProvider{
	public function render($view,$model=null,$is_hack=false,$content=null);
 }
