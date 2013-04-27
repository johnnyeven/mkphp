<?php
/**
 * CArrayModel class file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */

 namespace mkphp\core;

 class CArrayModel extends CModel implements Iterator{
	
	/**
	 *
	 */
	public function rewind(){
		reset($this->_c);
	}
	
	/**
	 *
	 */
    public function current(){
		$key =$this->key();
		return $key?$this->$key:$key;
	}
	
	/**
	 *
	 */
    public function key() {
		return key($this->_c);
	}
	
	/**
	 *
	 */
    public function next() {
		if(!next($this->_c))
			return false;
		return $this->current();
	}
	
	/**
	 *
	 */
    public function valid() {
		return ( $this->current() !== false );
	}
 }