<?php if(!defined('BASEPATH')) {exit('No direct script access allowed');}

class MY_Profiler extends CI_Profiler
{

	/**
	 * Run the Profiler
	 *
	 * @return	string
	 */
	public function run()
	{
		$output = '<div id="codeigniter_profiler" style="clear:both;background-color:#fff;padding:10px;">';
		$fields_displayed = 0;

		// instanciation des variable de classement et mise en forme de l'affichage
		$url_mem = '<div style="width: 35%; display: inline-block;">';
		$post_get = '<div style="margin-left: 3%; display: inline-block; width: 62%;">';
		$others = '<fieldset style="border:1px solid black;"><legend>&nbsp;&nbsp;Autres (<span style="cursor: pointer;" onclick="var s=document.getElementById(\'ci_profiler_others\').style;s.display=s.display==\'none\'?\'\':\'none\';this.innerHTML=this.innerHTML==\''.$this->CI->lang->line('profiler_section_hide').'\'?\''.$this->CI->lang->line('profiler_section_show').'\':\''.$this->CI->lang->line('profiler_section_hide').'\';">'.$this->CI->lang->line('profiler_section_show').'</span>)&nbsp;&nbsp;</legend><div id="ci_profiler_others" style="display: none;">';

		foreach ($this->_available_sections as $section)
		{
			if ($this->_compile_{$section} !== FALSE)
			{

				if($section == 'uri_string' || $section == 'memory_usage' || $section == 'controller_info')
				{// Classe les différentes catégories
					$func = '_compile_'.$section;
					$url_mem .= $this->{$func}();
					$fields_displayed++;
				} elseif ($section == 'post' || $section == 'get')
				{
					$func = '_compile_'.$section;
					$post_get .= $this->{$func}();
					$fields_displayed++;
				} else
				{
					$func = '_compile_'.$section;
					$others .= $this->{$func}();
					$fields_displayed++;
				}
			}
		}
		// Je ferme les balises ouvertes précédemment
		$url_mem .= '</div>';
		$post_get .= '</div>';
		$others .= '</div></fieldset>';

		if ($fields_displayed === 0)
		{
			// Il n'y a rien a afficher; Alors je vide les variables
			$url_mem = '';
			$post_get = '';
			$others = '';

			$output .= '<p style="border:1px solid #5a0099;padding:10px;margin:20px 0;background-color:#eee;">'
				.$this->CI->lang->line('profiler_no_profiles').'</p>';
		}

		return $output.$url_mem.$post_get.$others.'</div>';
	}
}
