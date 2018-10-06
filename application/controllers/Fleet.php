<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fleet
 *
 * @author Sabri
 */
class Fleet extends CI_Controller
{
	public function __construct()
	{
        parent::__construct();
//        $this->output->enable_profiler(TRUE);
        $this->load->model('Fleet_model', 'fleetMgr');
		$this->lang->load("fleet_lang", $this->config->item('language'));
    }
	/**
	 * 
	 * @param type $where
	 * @return type
	 */
    private function countFleet($where)
	{
        return (int) $this->fleetMgr->count($where);
    }
	
    public function index()
	{
        $this->listDisplay();
    }
    public function privateJet()
	{
        $this->listDisplay(1);
    }
    public function charter()
	{
        $this->listDisplay(2);
    }
    /**
	 * 
	 */
    public function listDisplay($type = "")
	{
		/* Current language */
		$lng = $this->lang->lang();
		
		/*** Building query ***/
		$order = 'passengers'; // order_by param
		
		$where = array(); // where param
		
		// form_validation rules
		$this->form_validation->set_rules('ajax', '', 'trim|numeric|xss_clean'); // input ajax
		if ($this->input->post('charter-type')) { $this->form_validation->set_rules('charter-type', '', 'trim|numeric|xss_clean'); } // chkbox charter
		if ($this->input->post('jet-type')) {$this->form_validation->set_rules('jet-type', '', 'trim|numeric|xss_clean'); }// chkbox jet
		if ($this->input->post('manufacturer')) { $this->form_validation->set_rules('manufacturer', '', 'trim|numeric|xss_clean'); } // select manufacturer
		if ($this->input->post('range')) { $this->form_validation->set_rules('range', '', 'trim|xss_clean'); $order = 'aircraft_range';} // select range
		if ($this->input->post('passengers')) { $this->form_validation->set_rules('passengers', '', 'trim|numeric|xss_clean'); $order = 'passengers'; } // select passengers
		
		if ($this->form_validation->run())// if form is ok
		{
			if ($this->input->post('charter-type') && !$this->input->post('jet-type')) { //if charter = checked & jet != checked
				$where['aircraft_type_id'] = $this->input->post('charter-type'); // set where clause
			}elseif ($this->input->post('jet-type') && !$this->input->post('charter-type')) { //if jet = checked & charter != checked
				$where['aircraft_type_id'] = $this->input->post('jet-type'); // set where clause
			}
			$where['manufacturer_id'] = $this->input->post('manufacturer'); // set where clause
			$where['passengers >='] = $this->input->post('passengers'); // set where clause
			$where['aircraft_range >='] = $this->input->post('range'); // set where clause
		} else { // while form is not submitted
			$where['aircraft_type_id'] = $type;// set type where clause on page load
		}
		
        $data = array();
		
		// add checked attribute in checkbox
		$data['jet_checked'] = isset($type) && !empty($type) && $type == 1?'checked':''; 
		$data['charter_checked'] = isset($type) && !empty($type) && $type == 2?'checked':'';
        
		// Get aircrafts
        $data['aircrafts'] = $this->fleetMgr->fleetList($order, $where);
        $data['nb_aircrafts'] = $this->countFleet($where);
		
        if(!empty($data["aircrafts"])){
			foreach ($data['aircrafts'] as $row) {
				$row->cruise_speed = speed_cvt($row->cruise_speed, $lng);
				$row->aircraft_range = range_cvt($row->aircraft_range, $lng);
            }
		}
		
		// Form select lists
		$data['manufact_list'] = $this->manuMgr->manufacturerList();
		// min & max values for form selects
		$data['max_passengers'] = $this->fleetMgr->getMathValue('passengers', 'max')->passengers;
		$data['min_passengers'] = $this->fleetMgr->getMathValue('passengers', 'min')->passengers;
		$data['max_range'] = $this->fleetMgr->getMathValue('aircraft_range', 'max')->aircraft_range;
		$data['min_range'] = $this->fleetMgr->getMathValue('aircraft_range', 'min')->aircraft_range;
		
		$this->layout->addCss('fleet');
		$this->layout->addJs('fleet');
		
        if(!empty($this->input->post())) { // form submitted: ajax
			$this->load->view('fleetajax',$data);
        } 
        else {
			$this->layout->view('fleet',$data);
		}
    }
	/**
	 * 
	 * @param type $id
	 */
	public function showAircraft($id)
	{
		if ($this->fleetMgr->entryExists(array("id" => $id)))
		{
			$data['single_aircraft'] = $this->fleetMgr->getAircraft($id);
			$this->layout->addCss('fleet');
			$this->layout->view("aircraft_details", $data);
		}
		else {
			redirect(base_url('fleet') ,'location');
		}
//		$cat=$data['article']->article_category_id;
//		$data['voiraussi'] = $this->artMgr->articleList("article_date desc", ['limit'=>10, 'start'=>0], $cat);
    }
}
