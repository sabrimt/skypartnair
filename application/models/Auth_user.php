<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_user extends CI_Model {
	protected $table = 'user';
	protected $_id;
	protected $_email;
	protected $_name;
	protected $_role;
	
	
	public function __construct() {
		parent::__construct();
		$this->load_from_session();
	}
	
	public function __get($key) {
		$method_name = 'get_property_' . $key;
		if(method_exists($this, $method_name)){
			return $this->$method_name();
		} else {
			return parent::__get($key);
		}
	}
	
	protected function clear_data() {
		$this->_id = NULL;
		$this->_email = NULL;
		$this->_name = NULL;
		$this->_role = NULL;
	}
	
	protected function clear_session() {
		$this->session->auth_user = NULL;
	}
	
	protected function get_property_id () {
		return $this->_id;
	}
	
	protected function get_property_is_connected () {
		return $this->_id !== NULL;
	}
	
	protected function get_property_is_ADMIN () {
		return $this->_role == "ADMIN";
	}
	
	protected function get_property_email () {
		return $this->_email;
	}
	
	protected function get_property_name () {
		return $this->_name;
	}
	
	protected function load_from_session () {
		if( $this->session->auth_user ) {
			$this->_id = $this->session->auth_user['id'];
			$this->_email = $this->session->auth_user['email'];
			$this->_name = $this->session->auth_user['name'];
			$this->_role = $this->session->auth_user['role'];
		} else {
			$this->clear_data();
		}
	}
	
	protected function load_user($email) {
		return $this->db->select('id, email, password, name, role')
						->from($this->table)
						->where('email', $email)
						->get()
						->first_row();
	}
	
	public function login($email,$password) {
		$user = $this->load_user($email);
		
		if(($user !== NULL) && hash_equals($user->password, crypt($password, $user->password))) {
			$this->_id = $user->id;
			$this->_email = $user->email;
			$this->_name = $user->name;
			$this->_role = $user->role;
			$this->save_session();
			
			$this->db->where('id', $user->id)
						->update($this->table, ['last_connection'=>date("Y-m-d")]);
		} else {
			$this->logout();
		}
	}
	
	public function logout() {
		$this->clear_data();
		$this->clear_session();
	}
	
	protected function save_session() {
		$this->session->auth_user = [
			'id'	=> $this->_id,
			'email' => $this->_email,
			'name'	=> $this->_name,
			'role'	=> $this->_role,
		];
	}

}