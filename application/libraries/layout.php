<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{
	private $CI;
	private $var = array();
    private $theme = 'default';
	
/*
|===============================================================================
| Constructeur
|===============================================================================
*/
	
	public function __construct()
	{
		$this->CI = get_instance();
        
        $this->var['output'] = '';
        
        // Le titre est composé du nom de la méthode et du nom du controlleur
        $this->var['title'] = ucfirst($this->CI->router->fetch_method()) . ' - ' . ucfirst($this->CI->router->fetch_class());
        
        /* Initialisation la variable $charset avec la même valeur que 
           la clé de configuration initialisée dans le fichier config.php */
        $this->var['charset'] = $this->CI->config->item('charset');
        
        // CSS / JS
        $this->var['css'] = array();
        $this->var['js'] = array();
		
		$this->CI->lang->load($this->theme . "_layout", $this->CI->config->item('language'));
	}
	
/*
|===============================================================================
| Méthodes pour charger les vues
|	. view
|	. views
|===============================================================================
*/
	
	public function view($name, $data = array())
	{
        $this->var['output'] .= $this->CI->load->view($name, $data, true);
	
        $this->CI->load->view('../themes/' . $this->theme, $this->var);
	}
	
	public function views($name, $data = array())
	{
        $this->var['output'] .= $this->CI->load->view($name, $data, true);
        return $this;
	}
    
/*
|===============================================================================
| Méthodes pour modifier les variables envoyées au layout
|	. setTitle
|	. setCharset
|===============================================================================
*/
    public function setTitle($title)
    {
       if (is_string($title) && !empty($title))
       {
           $this->var['title'] = $title;
           return TRUE;
       }
       return FALSE;
    }
    
    public function setCharset($charset)
    {
        if (is_string($charset) && !empty($charset))
        {
            $this->var['charset'] = $charset;
            return TRUE;
        }
        return FALSE;
    }
    /*
|===============================================================================
| Méthodes pour ajouter des feuilles de CSS et de JavaScript
|	. addCss
|	. addJs
|===============================================================================
*/
    public function addCss($nom, $media = "screen,projection")
    {
        if (is_string($nom) && !empty($nom) && file_exists('./assets/css/' . $nom . '.css'))
        {
            $this->var['css'][] = css_url($nom, $media);
            return TRUE;
        }
        return FALSE;
    }
    
    public function addJs($nom)
    {
        if(is_string($nom) && !empty($nom) && file_exists('./assets/js/' . $nom . '.js'))
        {
            $this->var['js'][] = js_url($nom);
            return TRUE;
        }elseif (preg_match("[^https]", $nom)) {
			$this->var['js'][] = $nom;
            return TRUE;
		}
        return FALSE;
    }
    
    /////////// Changement du theme ////////////
    public function setTheme($theme)
    {
        if (is_string($theme) && !empty($theme) && file_exists('./application/themes/' . $theme . '.php'))
        {
            $this->theme = $theme;
            return TRUE;
        }
        return FALSE;
    }
}

/* End of file layout.php */
/* Location: ./application/libraries/layout.php */

