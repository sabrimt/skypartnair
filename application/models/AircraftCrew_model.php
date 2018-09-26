<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AircraftCrew_model
 *
 * @author Sabri
 */
class AircraftCrew_model extends CI_Model
{
	private $table = 'aircraft_crew';
	
	public function count()
	{
		return (int) $this->db->count_all($this->table);
	}
    /**
	 * 
	 *
	 * @return array
	 */
    public function crewList():array
	{
        return $this->db->get($this->table)
						->result();
    }
    /**
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function getCrew(int $id)
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
    /**
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function deleteCrew(int $id):bool
	{
		if(!$this->entryExists(array("id" => $id))){
			return false;
		}
        return $this->db->where('id', $id)
                        ->delete($this->table);
    }
    /**
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function editCrew($id = null):bool
	{
		$data = array(
            'crew_fr' => $this->input->post('crew_fr'),
            'crew_en' => $this->input->post('crew_en'),
        );
	
		if($id != null){
			if(!$this->entryExists(array("id" => $id))){
				return false;
			}
			return $this->db->where('id', $id)
							->update($this->table, $data);
		}
		
		return $this->db->insert($this->table, $data);
    }
}
