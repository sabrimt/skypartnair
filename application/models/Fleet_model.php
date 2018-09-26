<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fleet_model
 *
 * @author Sabri
 */
class Fleet_model extends CI_Model
{
	private $table = 'fleet';
	
	public function __construct() {
		parent::__construct();
		
		//Relation tables
		$this->load->model('AircraftCategory_model', 'catMgr');
		$this->load->model('AircraftCrew_model', 'crewMgr');
		$this->load->model('AircraftType_model', 'typeMgr');
		$this->load->model('AircraftManufacturer_model', 'manuMgr');
	}
	
	public function count($where = array())
	{
		if(is_array($where) && !empty($where)){
			foreach ($where as $key => $value) {
				if($value != ""){
					$this->db->where($key, $value);
				}
			}
		}
		return (int) $this->db->count_all_results($this->table);
	}
    /**
	 * 
	 * @param string $order
	 * @return array
	 */
    public function fleetList(string $order = "passengers", $where = array()):array
	{
		if(is_array($where) && !empty($where)){
			foreach ($where as $key => $value) {
				if($value != ""){
					$this->db->where($key, $value);
				}
			}
		}
		if(!empty($result = $this->db->order_by($order)->get($this->table)->result()))
		{
			foreach ($result as $row)
			{
				$row->category = $this->catMgr->getCategory($row->aircraft_category_id);
				$row->crew = $this->crewMgr->getCrew($row->aircraft_crew_id);
				$row->type = $this->typeMgr->getType($row->aircraft_type_id);
				$row->manufacturer = $this->manuMgr->getManufacturer($row->manufacturer_id);
				
			}
		}
        return $result;
    }
    /**
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function getAircraft(int $id)
	{
		if(!empty($result = $this->db->get_where($this->table, array('id' => $id))->row()))
		{
			$result->category = $this->catMgr->getCategory($result->aircraft_category_id);
			$result->crew = $this->crewMgr->getCrew($result->aircraft_crew_id);
			$result->type = $this->typeMgr->getType($result->aircraft_type_id);
			$result->manufacturer = $this->manuMgr->getManufacturer($result->manufacturer_id);
		}
        return $result;
    }
	/**
	 * 
	 * @param int $id
	 * @param string $field
	 * @return type
	 */
	public function getValue(int $id, string $field) {
		return $this->db->select($field)
					->from($this->table)
					->where('id', $id)
					->get()
					->row();
	}
	/**
	 * 
	 * @param string $field
	 * @param string $method
	 * @param array $where
	 * @return type
	 */
	public function getMathValue(string $field, string $method, array $where = array())
	{
		$meth = $method != "" ? "select_$method" : 'select';
		$this->db->$meth($field);
		if(is_array($where) && !empty($where)){
			foreach ($where as $key => $value) {
				if($value != ""){
					$this->db->where($key, $value);
				}
			}
		}
		return $this->db->get($this->table)
					->row();
	}
	/**
	 * 
	 * @param array $param
	 * @return bool
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
	 * @return bool
	 */
    public function deleteAircraft(int $id):bool
	{
		if($this->entryExists(array("id" => $id))){
			return $this->db->where('id', $id)
                        ->delete($this->table);
		}
    }
    /**
	 * 
	 * @param int $id
	 * @param array $pth_elts
	 * @param bool $upload
	 * @return bool
	 */
    public function editAircraft($id, $pth_elts = array(), bool $upload):bool
	{
		$pth = implode('/', $pth_elts);
		
        $data = array(
            'model' => $this->input->post('model'),
            'passengers' => $this->input->post('passengers'),
            'cruise_speed' => $this->input->post('cruise_speed'),
            'aircraft_range' => $this->input->post('aircraft_range'),
			'description_en' => $this->input->post('description_en'),
			'description_fr' => $this->input->post('description_fr'),
            'aircraft_type_id' => $this->input->post('type'),
            'manufacturer_id' => $this->input->post('manufacturer'),
            'aircraft_category_id' => $this->input->post('category'),
            'aircraft_crew_id' => $this->input->post('crew'),
        );
		
		if($upload)
		{
			isset($this->upload->file_names['photo_exter'])? $data['photo_exter'] = "flotte/$pth/" . $this->upload->file_names['photo_exter']:"";
			isset($this->upload->file_names['photo_inter'])? $data['photo_inter'] = "flotte/$pth/" . $this->upload->file_names['photo_inter']:"";
			isset($this->upload->file_names['photo_plan'])? $data['photo_plan'] = "flotte/$pth/" . $this->upload->file_names['photo_plan']:"";
			isset($this->upload->file_names['photo_bonus'])? $data['photo_bonus'] = "flotte/$pth/" . $this->upload->file_names['photo_bonus']:"";
		}
		if($id != null){
			return $this->db->where('id', $id)
							->update($this->table, $data);
		}
		
		if($this->entryExists(array("model" => $this->input->post('model')))){
			return false;
		}
		
		return $this->db->insert($this->table, $data);
    }
}