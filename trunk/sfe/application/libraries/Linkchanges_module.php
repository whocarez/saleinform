<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Linkchanges module
 * Mazvv 03-05-2007
*/
class Linkchanges_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $current_uri_assoc = array();
	private $links_quan = 10;

	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->current_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->ciObject->load->model("linkchanges_model");
	}
	
	public function RenderLinkChangesArea(){
}