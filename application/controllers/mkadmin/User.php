<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mkadmin/User
 *
 * @author Sabro
 */
class User extends CI_controller
{
    public function __construct() {
        parent::__construct();
		
		if(!$this->auth_user->is_connected){
			redirect('mkadmin/dashboard');
			exit;
		}
        
        $this->load->model('User_model', 'usrMgr');
        $this->layout->setTheme('dashboard');
//        $this->output->enable_profiler(TRUE);
    }
    
    public function index() {
		if(!$this->auth_user->is_ADMIN){
			redirect('mkadmin/dashboard');
			exit;
		} else {
			$this->listDisplay();
		}
    }
    
    public function listDisplay() {
		if(!$this->auth_user->is_ADMIN){
			redirect('mkadmin/dashboard');
			exit;
		}
		
        $data = array();
        $data['nb_usr'] = $this->countUsers();
        $data['add_btn'] = anchor('mkadmin/user/newuser/', 'Ajouter un utilisateur', array("class" => "btn grey darken-4"));
        $data['users'] = $this->usrMgr->userList('role');
        foreach ($data['users'] as $user) {
			if($user->last_connection != null){
				$date = new DateTime($user->last_connection);
				$user->last_connection = date_format($date,'d/m/Y');
			} else {
				$user->last_connection = "Inconnu";
			}
        }
		
		$this->load->helper('security');
		
        if ($this->form_validation->run('roleform'))
		{
            if($this->usrMgr->editRole()){
				$this->session->set_flashdata("role-update", "Le rôle de l'utilisateur a été modifié");
				redirect(base_url('mkadmin/user') ,'location');
            }
		}
		
		$this->layout->addCss('delete_confirm');
		$this->layout->addJs('delete_confirm');
		$this->layout->views('delete_confirm');
        $this->layout->view('admin/users_list', $data);
    }
	
    public function newUser() {
		if(!$this->auth_user->is_ADMIN){
			redirect('mkadmin/dashboard');
			exit;
		}
		
        $this->load->helper('security');
		
		$form_data = array();
		
        if ($this->form_validation->run('newuserform') == FALSE)
        {
			$form_data['action'] = 'Ajout';
            $this->layout->view('admin/add_user', $form_data);
        }
        else
		{
			$data_success['back_btn'] = anchor('mkadmin/user/', 'RETOUR À LA LISTE', array("class" => "cancel-btn btn grey darken-1"));
			$data_success['item'] = "utilisateur";
			$data_success['entry_label'] = $this->input->post('email');
			
            if($this->usrMgr->addUser()){
				$this->layout->view('admin/success/formsuccess', $data_success);
            }
		}
    }
	
	public function editUser($id) {
		$this->load->helper('security');
		
		$form_data = array();
		
		if($id != null && $this->usrMgr->entryExists(["id" => $id]))
		{
			$form_data['single_user'] = $this->usrMgr->getUser($id);
			$form_data['action'] = 'Modification';
		}
		
		// is_unique management
		if($this->input->post('email') != $form_data['single_user']->email) {
			$is_unique =  'is_unique[user.email]';
		 } else {
			$is_unique =  '';
		 }
		$this->form_validation->set_rules('email', 'Email', $is_unique);
		
        if ($this->form_validation->run('usereditform') == FALSE)
        {
            $this->layout->view('admin/edit_user', $form_data);
        }
        else
		{
			$data_success['back_btn'] = anchor('mkadmin/user/', 'TABLEAU DE BORD', array("class" => "cancel-btn btn grey darken-1"));
			$data_success['item'] = "utilisateur";
			$data_success['entry_label'] = $this->input->post('email');
			
            if($this->usrMgr->editUser($id)){
				$this->layout->view('admin/success/formsuccess', $data_success);
            }
		}
	}
	
    private function countUsers() {
        return (int) $this->usrMgr->count();
    }
   
    public function deleteUser($id) {
		if(!$this->auth_user->is_ADMIN){
			redirect('mkadmin/dashboard');
			exit;
		}
		
        if($this->usrMgr->deleteUser($id)){
			$this->session->set_tempdata("role-update", "Le rôle de l'utilisateur a été modifié", 0);
		}
		redirect(base_url('mkadmin/user') ,'location');
    }
}
