<?php
/**
 * Description of Fleet
 *
 * @author Sabri
 */
class Fleet extends CI_Controller
{
	public function __construct() {
        parent::__construct();
		
		if(!$this->auth_user->is_connected){
			redirect('mkadmin/dashboard');
			exit;
		}
        
        $this->load->model('Fleet_model', 'fleetMgr');
        $this->layout->setTheme('dashboard');
//        $this->output->enable_profiler(TRUE);
        $form_data = array();
		
    }
    
    public function index() {
        $this->listDisplay();
    }
	
    private function countFleet() {
        return (int) $this->fleetMgr->count();
    }
   
    public function listDisplay() {
        $data = array();
		
        $data['nb_aircrafts'] = $this->countFleet();
		
		$data['add_btn'] = anchor('mkadmin/fleet/aircraftmanager/', 'Ajouter un appareil', array("class" => "btn marg grey darken-4"));
		
        $data['aircrafts'] = $this->fleetMgr->fleetList('passengers');
        
        $this->layout->addCss('delete_confirm');
		$this->layout->addJs('delete_confirm');
		$this->layout->views('delete_confirm');
		
        $this->layout->view('admin/fleet_list',$data);
    }
    
    public function aircraftManager($id = null) {
        $this->load->helper('security');
		
		$form_data['type_list'] = $this->typeMgr->typeList();
		$form_data['category_list'] = $this->catMgr->categoryList();
		$form_data['crew_list'] = $this->crewMgr->crewList();
		$form_data['manufacturer_list'] = $this->manuMgr->manufacturerList();
		$form_data['action'] = 'Ajout';
		
		// Liste des champs à uploader
		$input_list = array('photo_exter' => '"Photo exterieur"',
							'photo_inter' => '"Photo intérieur"',
							'photo_plan' => '"Photo plan"',
							'photo_bonus' => '"Photo bonus"',
		);
		
		// En cas de modification
		if($id != null && $this->fleetMgr->entryExists(array("id" => $id))){
			$form_data['single_aircraft'] = $this->fleetMgr->getAircraft($id);
			$form_data['action'] = 'Modification';
			
			// Récupération des chemins de fichiers en bdd
			$bdd_files = array();
			foreach ($input_list as $key => $value) {
				$bdd_files[$key] = $form_data['single_aircraft']->$key;
			}
		}
		
		// Si le formulaire n'est pas valide
        if ($this->form_validation->run('fleetform') == FALSE)
        {
			$this->layout->view('admin/fleet', $form_data);
        }
        else // Le formulaire est valide
        {
			// variable contenant les infos sur les dossiers à créer pour l'upload
			$manufact_dir = array();
			foreach($form_data['manufacturer_list'] as $manufact){
				if($manufact->id == $this->input->post('manufacturer')){
					$manufact_dir['manufacturer'] = str_replace(' ', '', strtolower($manufact->name));
					$manufact_dir['model'] = str_replace(' ', '', strtolower($this->input->post('model')));
				}
			}
					
			// Erreurs au niveau de l'upload
			if(($form_data['upload_errors'] = $this->multiUploadCheck($input_list, $manufact_dir, $form_data['action'])) !== TRUE){
				$this->layout->views('admin/fleet', $form_data);
				$this->upload->unlinkFiles();
			} else {
				$data_success['back_btn'] = anchor('mkadmin/fleet/', 'RETOUR À LA LISTE', array("class" => "cancel-btn btn grey darken-1"));
				$data_success['item'] = "appareil";
				$data_success['entry_label'] = $this->input->post('model');
			
				$data_up = empty($this->uploadList($input_list, $form_data['action'])) ? FALSE : TRUE;
				if($this->fleetMgr->editAircraft($id, $manufact_dir, $data_up)){
					if($id != null){
						$this->unlinkExisting($bdd_files);
					}
					$this->layout->view('admin/success/formsuccess', $data_success);
				}
			}
//
		}
    }
    
    public function deleteAircraft($id) {
		$dir_pth = FCPATH;
		
		$img_dir_pth = $this->fleetMgr->getValue($id, 'photo_exter')->photo_exter;
		
		if(!empty($img_dir_pth)){
			$db = substr($img_dir_pth, 0, (strrpos($img_dir_pth, '/')+1));
			if(is_dir($dir_pth = $dir_pth . $db)){
				$dir = opendir($dir_pth);
				while($file = readdir($dir)){
					if(!in_array($file, array(".", ".."))){
						unlink("$dir_pth$file");
					}
				} 
				closedir($dir);
				rmdir("$dir_pth");
			}
		}
		
		$this->fleetMgr->deleteAircraft((int) $id);
		redirect(base_url('mkadmin/fleet') ,'location');
    }
	/**
	 * 
	 * @param string $input
	 * @param string $label
	 * @param string $pth
	 * @return type
	 */
	public function doUpload(string $input, string $label, string $pth = "")
	{
		$config['upload_path']          = "./assets/img/flotte/$pth/";
		$config['allowed_types']        = 'jpg|png|jpeg';
//		$config['max_size']             = 100;
//		$config['max_width']            = 1524;
//		$config['max_height']           = 1100;
		$config['file_ext_tolower']     = TRUE;

		$this->load->library('upload', $config);
		$result = (bool) TRUE;
		
		if(!$this->upload->do_upload($input, $label)){
			$errors = $this->upload->display_errors("<span style='display: block'>", "</span>");
			$result = FALSE;
		}
		return !$result ? $errors : $result;
	}
	/**
	 * 
	 * @param array $input_list
	 * @param array $pth_elts
	 * @param string $action
	 * @return type
	 */
	public function multiUploadCheck(array $input_list, array $pth_elts = [], string $action = '') {
		// création des dossiers d'upload si inexistants
		$this->createDirectories($pth_elts);
		
		$pth = implode('/', $pth_elts);
	
		foreach ($input_list as $key => $value) {
			if($action == 'Modification' && empty($_FILES[$key]['name'])){
				unset($input_list[$key]);
			}
		}

		$check = (bool) TRUE;
		
		foreach ($input_list as $input => $label) {
			if(($response = $this->doUpload($input, $label, $pth)) !== TRUE){
				$errors = $response;
				$check = FALSE;
			}
		}
		return !$check ? $errors : $check;
	}
	/**
	 * Deletes files replaced in DB
	 * @param array $bdd_files
	 */
	public function unlinkExisting(array $bdd_files) {
		
		$path = FCPATH;
		foreach($bdd_files as $key => $val){
			if(isset($this->upload->file_names[$key])
			&& preg_match("/\.[a-zA-Z]{3,4}$/", $val)
			&& preg_match("/\.[a-zA-Z]{3,4}$/", $this->upload->file_names[$key])
			&& file_exists($path . $val)){
				unlink($path . $val);
			}
		}
	}
	/**
	 * 
	 * @param array $pth_elts
	 */
	public function createDirectories(array $pth_elts = array()) {
		
        if(!is_dir("./assets/img/flotte/$pth_elts[manufacturer]/")){
			mkdir("./assets/img/flotte/$pth_elts[manufacturer]/");
		}
        if(!is_dir("./assets/img/flotte/$pth_elts[manufacturer]/$pth_elts[model]/")){
			mkdir("./assets/img/flotte/$pth_elts[manufacturer]/$pth_elts[model]/");
		}
	}
	/**
	 * 
	 * @param array $input_list
	 * @param string $action
	 * @return array
	 */
	public function uploadList(array $input_list, string $action = ''):array
	{
		foreach ($input_list as $key => $value) {
			if($action == 'Modification' && empty($_FILES[$key]['name'])){
				unset($input_list[$key]);
			}
		}
		return $input_list;
	}
}