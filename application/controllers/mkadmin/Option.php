<?php
/**
 * Description of Option
 *
 * @author Sabri
 */
class Option extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		
		if(!$this->auth_user->is_connected){
			redirect('mkadmin/dashboard');
			exit;
		}
		
		$this->load->helper('security');
		
		$this->load->model('AircraftCategory_model', 'catMgr');
		$this->load->model('AircraftCrew_model', 'crewMgr');
		$this->load->model('AircraftManufacturer_model', 'manuMgr');
		
		$this->layout->setTheme('dashboard');
	}
	
	public function index() {
		$this->displayOptions();
	}
	
	public function displayOptions() {
		$this->layout->addCss('delete_confirm');
		$this->layout->addJs('delete_confirm');
		$this->layout->views('delete_confirm');
		$this->layout->setTitle('Gestion des options pour la flotte');
		
		$data = array();
		$data["categories"] = $this->catMgr->categoryList();
		$data["crews"] = $this->crewMgr->crewList();
		$data["manufacturers"] = $this->manuMgr->manufacturerList();
		
		$this->layout->view("admin/fleet_options", $data);
	}
	
	public function optionManager($origin = null, $id = null)
	{
//		$data['upload_error'] = '';
		
		// définit le formulaire validé
		$item = $origin != null ? $origin : $this->input->post('save');
		// définit les règles à valider par form_validation
		$validate = $item . 'form';
		
		switch ($item) {
			case "manufacturer":
				$manager = "manuMgr";
				
				if($id == null){
					$validate .= 'add';
				}
				//Définit la liste des drapeaux
				$data['flag_list'] = $this->manuMgr->flagList();
						
				break;
			case "category":
				$manager = "catMgr";
				
				if($id == null){
					$validate .= 'add';
				}
				break;
			default:
				$manager = $item . "Mgr";
				break;
		}
		
		$data['form'] = $item;
		if ($this->form_validation->run($validate) == FALSE)
        {
			$data['action'] = 'Ajout';
            if($id != null && $this->$manager->entryExists(array("id" => $id))){
				$method = 'get' . ucfirst($item);// METHODE générée
				
                $data['single_' . $item] = $this->$manager->$method($id);// Variable envoyée dans la vue générée
				$data['action'] = 'Modification';
            }
			$this->layout->views('admin/options_form', $data);
        }
        else
        {
			$data_success['back_btn'] = '';
			$data_success['item'] = "option";
			$data_success['entry_label'] = $item;
			
			$method = 'edit' . ucfirst($item);
			
            $this->$manager->$method($id);
            $this->layout->views('admin/success/formsuccess', $data_success);
			
        }
		$this->displayOptions();
	}
	/**
	 * 
	 * @param string $item
	 * @param type $id
	 */
	public function deleteOption($item, $id) {
		switch ($item) {
			case "manufacturer":
				$manager = "manuMgr";
				break;
			case "category":
				$manager = "catMgr";
				break;
			default:
				$manager = $item . "Mgr";
				break;
		}
		$method = 'delete' . ucfirst($item);
		
        $this->$manager->$method($id);
		redirect(base_url('mkadmin/option/optionmanager') ,'location');
    }
}
