<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AircraftType_model
 *
 * @author Sabri
 */
class AircraftType_model extends CI_Model
{
	private $table = 'aircraft_type';

    /**
	 *
	 * @return array
	 */
    public function typeList():array
	{
        return $this->db->get($this->table)
						->result();
    }
    /**
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function getType(int $id)
	{
		if(!$this->entryExists(array("id" => $id))){
			return false;
		}
        return $this->db->get_where($this->table, array('id' => $id))
						->row();
    }
	/**
	 * 
	 * @param array $param
	 * @return bool
	 */
    public function entryExists($param = array()):bool
	{
        if (empty ($this->db->get_where($this->table, $param)->result()))
        {
            return false;
        }
        return true; 
    }
}
