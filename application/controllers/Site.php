<?php
defined ('BASEPATH') OR exit('No_direct_script_access_allowed');


class Site extends CI_Controller {
    
	public function __construct()
    {
        parent::__construct();
				$this->lang->load("home_lang", $this->config->item('language'));
				$this->load->model('Article_model', 'artMgr');
    }
	
    public function index () {
				$data = array();
        $this->layout->setTitle("SKY PARTNAIR – Location jet privé, location avion de ligne, avion privé, vol charter. Affrètement d'avion ");

        $this->layout->addJs("pickadate");

				$this->layout->addCss('blog');
				//		$this->layout->addCss('onepage-scroll');
				//		$this->layout->addCss('onepage-scroll2');
				$this->layout->addJs('animation');
				//		$this->layout->addJs('onepage-scroll');
				
				$lng = $this->lang->lang();


				$data['session'] = $this->session->userdata;

				$data['articles'] = $this->blogDisplay();

				// ********  Parallax form

				// Prise en compte du champ date retour
				$formval = 'homemailform';
				$postvar = $this->input->post("envoidevis");
				
				if(isset($postvar) && $postvar == "ar")
				{ // Si vrai = vol A/R
					$formval .= '_ar';
				}
				
				if ($this->form_validation->run($formval) == FALSE)
				{
					$this->layout->view("index", $data);
				}else {
					$this->sendMail();
					$this->layout->view('index',$data);
				}
			}
			
			
			public function devis () {
				
				$data["title"] = "Devis Jet privé";
        $this->layout->view("devis", $data);
				
			}
			
			
			private function sendMail() {
				// Current language
				$lng = $this->lang->lang();
				$mail_data =array();
				
				// Infos venant du form
				$mail_data['form_mail'] = new stdClass();
				$mail_data['form_mail']->form_type = $this->input->post("envoidevis");
				
				$mail_data['form_mail']->form_email = $this->input->post("email");
				$mail_data['form_mail']->form_phone = $this->input->post("phone");
				
				$mail_data['form_mail']->form_name = ucwords($this->input->post("name"));

		$mail_data['form_mail']->form_departure = $this->input->post("departure");

		$mail_data['form_mail']->form_destination = $this->input->post("destination");

		$mail_data['form_mail']->form_dep_date = $this->input->post("dep-date");

		if($mail_data['form_mail']->form_type == "ar") {

			$mail_data['form_mail']->form_des_date = $this->input->post("des-date");
		}

		//Load email library 
		$this->load->library('email'); 

		$this->email->to("mtirsabri2004@yahoo.fr");
		$this->email->from($mail_data['form_mail']->form_email);
		$this->email->subject("✈ DEMANDE DEVIS MINI");
		$mail_template = $this->load->view('email/homemail', $mail_data, true);
		$this->email->message($mail_template);

		//Send mail 
		if($this->email->send()){
			$this->session->set_flashdata("email_sent", t('home_lang_email_success'));
			redirect(base_url() ,'location');
		}else{
			$this->session->set_flashdata("email_sent", t('home_lang_email_success'));
			redirect(base_url() ,'location');
		}
	}


	public function blogDisplay() {

		$lng = $this->lang->lang();
		$articles = $this->artMgr->articleList("article_date desc", ['limit'=>3, 'start'=>0] );

//		debug($data['articles']);
		foreach ($articles as $articl) {
            $articl->article_date = date_cvt($articl->article_date, $lng);
        }
		return $articles;
//
//		$this->layout->addJs('blog');
//		$this->layout->addCss('blog');
	}
}