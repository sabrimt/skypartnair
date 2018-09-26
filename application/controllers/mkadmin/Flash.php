<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mkadmin/Flash
 *
 * @author Sabro
 */
class Flash extends CI_controller
{
    public function __construct() {
        parent::__construct();
		
		if(!$this->auth_user->is_connected){
			redirect('mkadmin/dashboard');
			exit;
		}
        
        $this->load->model('Flash_model', 'fsManager');
        $this->layout->setTheme('dashboard');
//        $this->output->enable_profiler(TRUE);
    }
    
    public function index() {
        $this->listDisplay();
    }
    
    public function listDisplay() {
        $data = array();
        $data['nb_sale'] = $this->countSales();
        $data['add_btn'] = anchor('mkadmin/flash/salesmanager/', 'Ajouter une vente flash', array("class" => "btn grey darken-4"));
        $data['sales'] = $this->fsManager->flashList();
        foreach ($data['sales'] as $sale) {
            $date = new DateTime($sale->from_date);
            $sale->from_date = date_format($date,'d/m/Y');
            
            if($sale->to_date != null){
                $date = new DateTime($sale->to_date);
                $sale->to_date = date_format($date,'d/m/Y');
            }
        }
		$this->layout->addCss('delete_confirm');
		$this->layout->addJs('delete_confirm');
		$this->layout->views('delete_confirm');
        $this->layout->view('admin/flash_sales_list', $data);
    }
	
    public function salesManager($id = null) {
		
        $this->load->helper('security');
        $this->layout->addJs("pickadate");
		
		$form_data = array();
        $form_data['fleet_list'] = $this->fleMgr->fleetList();
		
        if ($this->form_validation->run('flashform') == FALSE)
        {
			$form_data['action'] = 'Ajout';
            if($id != null && $this->fsManager->entryExists(["id" => $id]))
			{
                $form_data['single_sale'] = $this->fsManager->getSale($id);
				$form_data['action'] = 'Modification';
            }
            $this->layout->view('admin/flash_sales', $form_data);
        }
        else
		{
			$data_success['back_btn'] = anchor('mkadmin/flash/', 'RETOUR À LA LISTE', array("class" => "cancel-btn btn grey darken-1"));
			$data_success['item'] = "vente";
			$data_success['entry_label'] = $this->input->post('departure') . ' >>> ' . $this->input->post('arrival');
			
            if($this->fsManager->editSale($id)){
				$this->layout->view('admin/success/formsuccess', $data_success);
            }
		}
    }
    
    private function countSales() {
        return (int) $this->fsManager->count();
    }
   
    public function deleteSale($id) {
        $this->fsManager->deleteSale($id);
		redirect(base_url('mkadmin/flash') ,'location');
    }
}
