<?php
/**
 * ISerializer interface file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 
 namespace mkphp\data;

 /**
 * 
 *
 */
 interface ISerializer{
	public function serialize($mixed);
	public function unserialize($data);
 }
