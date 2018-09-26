<?php
/**
 * Description of user
 *
 * @author Sabro
 */
class User_model extends CI_Model
{
    private $table = 'user';
	
    public function __construct() {
        parent::__construct();

    }
	
    /**
	 * 
	 * @return int
	 */
    public function count()
	{
		return $this->db->count_all($this->table);
	}
    /**
	 * 
	 * @param string $order
	 * @return array
	 */
	public function userList(string $order = "name"):array
	{
		$this->db->select('id, name, email, role, last_connection');
        $result = $this->db->order_by($order)->get($this->table)->result();
        return $result;
    }
	
     /**
	 * 
	 * @param int $id
	 * @return array
	 */
    public function getUser(int $id) {
		if($this->entryExists(['id' => $id])){
			$this->db->select('id, name, email, role, last_connection');
			$user = $this->db->get_where($this->table, array('id' => $id))
							->row();
			return $user;
		}
		return false;
    }
	
    /**
	 * 
	 * @param array $param
	 * @return boolean
	 */
    public function entryExists(array $param):bool
	{
        if (empty ($this->db->get_where($this->table, $param)->result()))
        {
            return false;
        }
        return true;
    }
	
     /**
	 * 
	 * @param int $id
	 * @return boolean
	 */
    public function deleteUser(int $id):bool {
        return $this->db->where('id', $id)
                        ->delete($this->table);
    }
	
     /**
	 * 
	 * @return boolean
	 */
    public function addUser():bool {
		$password = $this->input->post('password');
		$cost = 10;
		$salt = uniqid(mt_rand(), true);
		$salt = sprintf("$2a$%02d$", $cost) . $salt;
		$hash = crypt($password, $salt);
		
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'role' => $this->input->post('role')==="on"?"ADMIN":"USER",
            'password' => $hash,
        );
		return $this->db->insert($this->table, $data);
    }
	
	public function editRole() {
		echo 'on y est';
		if($this->input->post('role-check') == "on"){
			echo 'oui oui';
			$role = "ADMIN";
		} else {
			$role = "USER";
		}
		$data = array(
            'role' => $role,
        );
		return $this->db->where('id', $this->input->post('rolesave'))
						->update($this->table, $data);
	}
	
	public function editUser($id):bool {
		$password = $this->input->post('password');
		$cost = 10;
		$salt = uniqid(mt_rand(), true);
		$salt = sprintf("$2a$%02d$", $cost) . $salt;
		$hash = crypt($password, $salt);
		
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $hash,
        );
		return $this->db->where('id', $id)
						->update($this->table, $data);
	}
}
