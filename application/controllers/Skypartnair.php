<?php

class Skypartnair extends CI_Controller {
	
	   public function __construct()
    {
        parent::__construct();
		$this->lang->load("skypartnair_lang", $this->config->item('language'));
		$this->layout->setTheme('default');
        
    }
	
	public function index() {
		
		
		$this->layout->view('skypartnair');
		
	}
}
