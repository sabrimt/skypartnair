<?php
/**
 * Description of Group
 *
 * @author Pierre-Antoine
 */

class Group extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->lang->load("group_lang", $this->config->item('language'));
		$this->lang->load("privatejet_lang", $this->config->item('language'));
		$this->layout->setTheme('default');
        
    }
	
	public function index() {

		$data['session'] = $this->session->userdata;
		$this->layout->view('group', $data);
		
	}
	
	public function freeQuote($multi = "") {
		$data = array();
		$data['multi_chkd'] = !empty($multi) && $multi == "multidestination" ? 'checked' : '';
		
        $this->load->helper('security');
        $this->layout->addCss("freequote");
        $this->layout->addJs("pickadate");
        $this->layout->addJs("freequote");
		
		
		// Form validation rules
		$lng = $this->lang->lang();
		$timeLine = $this->lang->line("privatejet_lang_time_val");
		
		$tdep = $lng == 'en' ? '(departure)' : '(départ)';
		$tret = $lng == 'en' ? '(return)' : '(retour)';
		$tstp = $lng == 'en' ? '(step %s)' : '(étape %s)';
		
		// Add rules for first name input if not company
		$firstname_conf = '';// rules for first name input
		$name_comp_lbl = 'lang:privatejet_lang_comp';// last name or company label
		if($this->input->post('gender') != 'Sté'){
			$firstname_conf = array( "field" => "first-name", "label" => "lang:privatejet_lang_first_name", "rules" => "trim|required");
			$name_comp_lbl = 'lang:privatejet_lang_name';
		}
		
		$config = array(array( "field" => "travel-type", "label" => "lang:privatejet_lang_travel_type", "rules" => "trim|in_list[owq,rq,mq]|required"),
			array( "field" => "gender", "label" => "lang:privatejet_lang_gender", "rules" => "trim|required"),
			array( "field" => "name", "label" => $name_comp_lbl, "rules" => "trim|required"),
			$firstname_conf,
			array( "field" => "phone", "label" => "lang:privatejet_lang_phone", "rules" => "trim|regex_match[/^\+\d+/]|min_length[8]|required"),
			array( "field" => "email", "label" => "Email", "rules" => "trim|required|valid_email"),
			array( "field" => "message", "label" => "lang:privatejet_lang_req", "rules" => "trim|max_length[300]"),
			array( "field" => "passengers", "label" => "lang:privatejet_lang_passengers", "rules" => "trim|required|xss_clean"),
			array( "field" => "budget", "label" => "Budget", "rules" => "trim|min_length[3]|max_length[8]|numeric|xss_clean"),
			array( "field" => "departure", "label" => "lang:privatejet_lang_dep_city", "rules" => "trim|required|xss_clean"),
			array( "field" => "departure_date", "label" => "lang:privatejet_lang_dep_date", "rules" => "trim|required|xss_clean"),
			array( "field" => "departure_time", "label" => sprintf($timeLine, $tdep), "rules" => "trim|required|xss_clean"),
			
		);
		
		// Add rules to form if multi destination is selected
		if($this->input->post("travel-type") == "mq") {
			$nb_fields = $this->input->post("save");
			for($stp = 1; $stp <= $nb_fields; $stp ++){
				$config[] = array( "field" => "step_$stp", "label" => sprintf($this->lang->line("privatejet_lang_stp_city_val"), $stp), "rules" => "trim|required|xss_clean");
				if ($stp != $nb_fields){
					$config[] = array( "field" => "date_step_$stp", "label" => sprintf($this->lang->line("privatejet_lang_stp_date_val"), $stp), "rules" => "trim|required|xss_clean");
					$config[] = array( "field" => "time_step_$stp", "label" => sprintf($timeLine, sprintf($tstp, $stp)), "rules" => "trim|required|xss_clean");
				}
			}
			$return = $this->input->post("destination");
			if(isset($return)) {// return fields selected
				$config[] = array( "field" => "destination", "label" => "lang:privatejet_lang_dest_city", "rules" => "trim|required|xss_clean");
				$config[] = array( "field" => "return_date", "label" => "lang:privatejet_lang_dest_date", "rules" => "trim|required|xss_clean");
				$config[] = array( "field" => "return_time", "label" => sprintf($timeLine, $tret), "rules" => "trim|required|xss_clean");
			}
		}
		
		// Add rules to form if return or one way travel are selected
		if($this->input->post("travel-type") == "rq" || $this->input->post("travel-type") == "owq") {
			$config[] = array( "field" => "destination", "label" => "lang:privatejet_lang_dest_city", "rules" => "trim|required|xss_clean");
		}
		
		// Add rules to form if return travel is selected
		if($this->input->post("travel-type") == "rq") {
			$config[] = array( "field" => "return_date", "label" => "lang:privatejet_lang_dest_date", "rules" => "trim|required|xss_clean");
			$config[] = array( "field" => "return_time", "label" => sprintf($timeLine, $tret), "rules" => "trim|required|xss_clean");
		}
		
		
		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == FALSE)
        {
			$data['session'] = $this->session->userdata;
			$this->layout->view('freequote', $data);
        }else {
			$this->sendQuoteMail();
		}
	}
	
	private function sendQuoteMail() {
		// Current language
//		$lng = $this->lang->lang();
		$mail_data =array();
		// Number of steps
		$mail_data['nb_steps'] = $this->input->post("save");
		$mail_data['tvl_type'] = $this->input->post("travel-type");

		// Infos venant du form
		$mail_data['form_mail'] = new stdClass();
		$mail_data['form_mail']->form_gender = $this->input->post("gender");
		$mail_data['form_mail']->form_name = strtoupper($this->input->post("name"));
		$mail_data['form_mail']->form_first_name = ucwords($this->input->post("first-name"));
		$mail_data['form_mail']->form_email = $this->input->post("email");
		$mail_data['form_mail']->form_phone = $this->input->post("phone");
		
		$mail_data['form_mail']->form_passengers = $this->input->post("passengers");
		$mail_data['form_mail']->form_budget = $this->input->post("budget").' €';
		$mail_data['form_mail']->form_message = $this->input->post("message");
		
		$mail_data['form_mail']->departure = $this->input->post("departure");
		$mail_data['form_mail']->dep_date = date_cvt($this->input->post("departure_date_submit"), 'fr', false);
		$mail_data['form_mail']->dep_time = $this->input->post("departure_time");
		if($mail_data['nb_steps'] > 0 && $mail_data['tvl_type'] == 'mq'){
			for($step = 1; $step <= $mail_data['nb_steps']; $step++) {
				$stp = 'step_'.$step;
				$dat = 'date_s'.$step;
				$tim = 'time_s'.$step;
				
				$mail_data['form_mail']->$stp = $this->input->post("step_$step");
				$mail_data['form_mail']->$dat = date_cvt($this->input->post("date_step_".$step."_submit"), 'fr', false);
				$mail_data['form_mail']->$tim = $this->input->post("time_step_$step");
			}
		}

		$mail_data['form_mail']->destination = $this->input->post("destination");
		$mail_data['form_mail']->ret_date = date_cvt($this->input->post("return_date_submit"), 'fr', false);
		$mail_data['form_mail']->ret_time = $this->input->post("return_time");
		
		//Load email library 
		$this->load->library('email'); 

		$this->email->to("mtirsabri2004");
		$this->email->from("sabrimtir9@gmail.com");
		$this->email->subject("✈ DEMANDE DE DEVIS GRATUIT");
		$mail_template = $this->load->view('email/freequotemail', $mail_data, true);
		$this->email->message($mail_template);

		//Send mail 
		if($this->email->send()){
			$this->session->set_flashdata("email_sent", t("privatejet_lang_email_success"));
			redirect(base_url('group') ,'location');
		}else{
			$this->session->set_flashdata("email_sent", t("privatejet_lang_email_error"));
//			show_error($this->email->print_debugger());
			redirect(base_url('group/freequote') ,'location');
		}
		
	}
}
