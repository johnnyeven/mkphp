<?php
/**
 * IHttpRequest interface file.
 *
 * @author Kiba Zhao <kiba.maple@gmail.com>
 */
 
 namespace mkphp\web;

 /**
 * 
 *
 */
 interface IHttpRequest{
	/**
	 *
	 */
	public function getServer();
	
	/**
	 *
	 */
	public function getCookie();
	
	/**
	 *
	 */
	public function getGet();
	
	/**
	 *
	 */
	public function getPost();
	
	/**
	 *
	 */
	public function getFiles();
	
	/**
	 *
	 */
	public function getSession();
	
	/**
	 *
	 */
	public function getBody();
 }
