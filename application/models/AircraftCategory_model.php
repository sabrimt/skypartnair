<?php
/**
 * Description of AircraftCategory_model
 *
 * @author Sabri
 */
class AircraftCategory_model extends CI_Model
{
	private $table = 'aircraft_category';
	
	public function count()
	{
		return (int) $this->db->count_all($this->table);
	}
    /**
	 * 
	 * @return array
	 */
    public function categoryList():array
	{
        
        return $this->db->get($this->table)
                ->result();
    }
    /**
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function getCategory(int $id)
	{
		if(!$this->entryExists(array("id" => $id))){
			return false;
		}
        return $this->db->get_where($this->table, array('id' => $id))->row();
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
    public function editCategory($id = null):bool
	{
		$data = array(
            'category' => $this->input->post('category'),
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
	/**
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function deleteCategory(int $id):bool
	{
		if(!$this->entryExists(array("id" => $id))){
			return false;
		}
        return $this->db->where('id', $id)
                        ->delete($this->table);
    }
}
