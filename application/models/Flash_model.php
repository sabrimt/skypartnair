<?php
/**
 * Description of ventes
 *
 * @author Sabro
 */
class Flash_model extends CI_Model
{
    private $table = 'sale';
	
    public function __construct() {
        parent::__construct();
		// relation tables
		$this->load->model('Fleet_model', 'fleMgr');
    }
	
    /**
	 * 
	 * @return int
	 */
    public function count(string $date = "2017-11-01")
	{
		return $this->db->where("to_date >= ",$date)
							->or_where("from_date >= ", $date)
							->get($this->table)
							->num_rows();		
	}
   /**
    * 
    * @param type $order
    * @param array $date
    * @return array
    */
public function flashList($order = "from_date desc", string $date = "2017-01-11"):array
	{
        if(!empty($result = $this->db->order_by($order)	->where("to_date >= ", $date)
														->or_where("from_date >= ", $date)
														->get($this->table)->result()))
        {
            foreach ($result as $row)
            {
                $row->fleet = $this->fleMgr->getAircraft($row->fleet_id);
            }
        }
        return $result;
    }
	
     /**
	 * 
	 * @param int $id
	 * @return array
	 */
    public function getSale(int $id) {
		if($this->entryExists(['id' => $id])){
			$sale = $this->db->get_where($this->table, array('id' => $id))
							->row();
			$sale->fleet = $this->fleMgr->getAircraft($sale->fleet_id);
			return $sale;
		}
		return false;
    }
	
    /**
	 * 
	 * @param array $id
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
    public function deleteSale(int $id):bool {
        return $this->db->where('id', $id)
                        ->delete($this->table);
    }
	
     /**
	 * 
	 * @param int $id
	 * @return boolean
	 */
    public function editSale($id):bool {
        $data = array(
            'departure' => $this->input->post('departure'),
            'arrival' => $this->input->post('arrival'),
            'from_date' => $this->input->post('from_date_submit'),
			'capacity' => $this->input->post('capacity'),
            'price' => $this->input->post('price'),
            'fleet_id' => $this->input->post('fleet_id'),
        );
        $data['to_date'] = !empty($this->input->post('to_date_submit'))? $this->input->post('to_date_submit'):null;
		
        if($id != null){
			return $this->db->where('id', $id)
							->update($this->table, $data);
		}
		
		return $this->db->insert($this->table, $data);
    }
}
