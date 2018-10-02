<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vente
 *
 * @author Sabro
 */
class Flash extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        
        $this->load->model('Flash_model', 'fsManager');
		$this->lang->load("flash_lang", $this->config->item('language'));
		
	}
	

	
    private function countSales() {
		 $date = date("Y-m-d"); 
        return (int) $this->fsManager->count($date);
	}
	
    
    public function index() {
        $this->listDisplay();
	}
	
    
    public function listDisplay() {
		// Current language
		$lng = $this->lang->lang();
		
        $data = array();
        $date = date("Y-m-d"); 
		$data['session'] = $this->session->userdata;
        $data['sales'] = $this->fsManager->flashList("from_date desc", $date);
        $data['nb_sale'] = $this->countSales();
		
        if(!empty($data["sales"])){
            foreach ($data['sales'] as $sale) {
                $sale->from_date = date_cvt($sale->from_date, $lng);

                if($sale->to_date != null){
                   $sale->to_date = date_cvt($sale->to_date, $lng);
                }
				
				$sale->fleet->cruise_speed = speed_cvt($sale->fleet->cruise_speed, $lng);
				$sale->fleet->aircraft_range = range_cvt($sale->fleet->aircraft_range, $lng);
            }
        }
		
		if ($this->form_validation->run('flashmailform') == FALSE)
        {
			$this->layout->view('flash_sales_front',$data);
        }else {
			$this->sendFlashMail();
			$this->layout->view('flash_sales_front',$data);
		}
        
	}
	

	private function sendFlashMail() {
		// Current language
		$lng = $this->lang->lang();
		
		$mail_data =array();
		// Id Vente
		$sale_id = $this->input->post("send");

		// Infos Vente
		$mail_data['form_sale'] = $this->fsManager->getSale($sale_id);
		$mail_data['form_sale']->dispo = date_cvt($mail_data['form_sale']->from_date, 'fr', false).(!empty($mail_data['form_sale']->to_date)? ' > '.date_cvt($mail_data['form_sale']->to_date, 'fr', false):'');

		// Infos venant du form
		$mail_data['form_mail'] = new stdClass();
		$mail_data['form_mail']->to_email = $this->input->post("email");
		$mail_data['form_mail']->form_phone = $this->input->post("phone");
		$mail_data['form_mail']->form_name = ucwords($this->input->post("name"));
		$mail_data['form_mail']->form_gender = $this->input->post("gender");
		$mail_data['form_mail']->form_message = $this->input->post("message");

		//Load email library 
		$this->load->library('email'); 

		$this->email->to("mtirsabri2004@yahoo.fr");
		$this->email->from("pierreantoine.wurmser@gmail.com");
		$this->email->subject("✈ DEMANDE VENTE FLASH #$sale_id");
		$mail_template = $this->load->view('email/flashmail', $mail_data, true);
		$this->email->message($mail_template);

		//Send mail 
		if($this->email->send()){
			$this->session->set_flashdata("email_sent",t("flash_lang_email_success"));
			redirect(base_url('flash') ,'location');
		}else{
			$this->session->set_flashdata("email_sent",t("flash_lang_email_error"));
			redirect(base_url('flash') ,'location');
		}
		
	}
}
