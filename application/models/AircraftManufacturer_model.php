<?php
/**
 * Description of AircraftManufacturer_model
 *
 * @author Sabri
 */
class AircraftManufacturer_model extends CI_Model
{
	/**
	 * BDD TABLE
	 * @var string
	 */
	private $table = 'aircraft_manufacturer';
	/**
	 * LIST OF MANUFACTURERS COUNTRY
	 * @var array 
	 */
	private $flag_list = array('Allemagne' => 'germany.jpg',
								'Brésil' => 'brazil.jpg',
								'Canada' => 'canada.jpg',
								'Chine' => 'china.jpg',
								'Corée du sud' => 'south-corea.jpg',
								'États-Unis' => 'usa.jpg',
								'France' => 'france.jpg',
								'Inde' => 'india.jpg',
								'Israël' => 'israel.jpg',
								'Italie' => 'italy.jpg',
								'Japon' => 'japan.jpg',
								'Royaume-Uni' => 'uk.jpg',
								'Suède' => 'sweden.jpg',
								'Suisse' => 'switzerland.jpg',
								'Union Européenne' => 'eu.jpg',
							);
	/**
	 * 
	 * @return int
	 */
	public function count():int
	{
		return (int) $this->db->count_all($this->table);
	}
    /**
	 * 
	 * @param string $order
	 */
    public function manufacturerList(string $order = "name")
	{
        return $this->db->order_by($order)
                ->get($this->table)
                ->result();
    }
    /**
	 * 
	 * @param int $id
	 */
    public function getManufacturer(int $id)
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
    public function deleteManufacturer(int $id):bool
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
    public function editManufacturer($id = null):bool
	{
		$data = array(
            'name' => $this->input->post('name'),
            'flag' => $this->input->post('flag'),
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
	 * @return array
	 */
	public function flagList():array {
		return $this->flag_list;
	}
}
