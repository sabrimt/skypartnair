<?php
//defined ('BASEPATH') OR exit('No_direct_script_access_allowed');

class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent:: __construct();
        
        $this->layout->setTheme('dashboard');
    }
    
    public function index() { 
        $this->layout->setTitle("MK Partnair – DASHBOARD ");
		
		if(!$this->auth_user->is_connected){
			$this->connexion();
		}else {
			$this->layout->view('admin/dashboard');
		}
    }
	
	public function connexion() {
		$data = array();
		
		if ( $this->form_validation->run('authenticationform') ) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$this->auth_user->login($email, $password);
			if($this->auth_user->is_connected) {
				redirect('mkadmin/dashboard');
			} else {
				$data['login_error'] = "Les identifiants saisis sont incorrects";
			}
		}
		$this->layout->view('admin/connexion', $data);
	}
	public function deconnexion() {
		$this->auth_user->logout();
		redirect('mkadmin/dashboard');
	}
}

