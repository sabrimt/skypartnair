<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
* Language Identifier
* 
* Adds a language identifier prefix to all site_url links
* 
* @copyright     Copyright (c) 2011 Wiredesignz
* @version         0.29
* 
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
* 
* The above copyright notice and this permission notice shall be included in
* all copies or substantial portions of the Software.
* 
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
* THE SOFTWARE.
*/
class MY_Lang extends CI_Lang
{
    function __construct() {
        
        global $URI, $CFG, $IN;
        
        $config =& $CFG->config;
        
        $index_page    = $config['index_page'];
        $lang_ignore   = $config['lang_ignore'];
        $default_abbr  = $config['language_abbr'];
        $lang_uri_abbr = $config['lang_uri_abbr'];
        
        /* get the language abbreviation from uri */
        $uri_abbr = $URI->segment(1);

        /* adjust the uri string leading slash */
        $URI->uri_string = preg_replace("|^\/?|", '/', $URI->uri_string);
        
        if ($lang_ignore) {
            
            if (isset($lang_uri_abbr[$uri_abbr])) {
            
                /* set the language_abbreviation cookie */
                $IN->set_cookie('user_lang', $uri_abbr, $config['sess_expiration']);
                
            } else {
                
                /* get the language_abbreviation from cookie */
                $lang_abbr = $IN->cookie($config['cookie_prefix'].'user_lang');
            
            }
            
            if (strlen($uri_abbr) == 2) {
                
                /* reset the uri identifier */
                $index_page .= empty($index_page) ? '' : '/';
                
                /* remove the invalid abbreviation */
                $URI->uri_string = preg_replace("|^\/?$uri_abbr\/?|", '', $URI->uri_string);
            
                /* redirect */
                header('Location: '.$config['base_url'].$index_page.$URI->uri_string);
                exit;
            }
            
        } else {
            
            /* set the language abbreviation */
            $lang_abbr = $uri_abbr;
        }

        /* check validity against config array */
        if (isset($lang_uri_abbr[$lang_abbr])) {
           
           /* reset uri segments and uri string */
           $URI->segment(array_shift($URI->segments));
           $URI->uri_string = preg_replace("|^\/?$lang_abbr|", '', $URI->uri_string);
           
           /* set config language values to match the user language */
           $config['language'] = $lang_uri_abbr[$lang_abbr];
           $config['language_abbr'] = $lang_abbr;
            
           /* if abbreviation is not ignored */
           if ( ! $lang_ignore) {
                   
                   /* check and set the uri identifier */
                   $index_page .= empty($index_page) ? $lang_abbr : "/$lang_abbr";
                
                /* reset the index_page value */
                $config['index_page'] = $index_page;
           }

           /* set the language_abbreviation cookie */               
           $IN->set_cookie('user_lang', $lang_abbr, $config['sess_expiration']);
           
        } else {
                       
            /* if abbreviation is not ignored */   
            if ( ! $lang_ignore) {
				/* Check the browser's language */
				$lang_browser = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
				if (isset($lang_uri_abbr[$lang_browser])) {
					$index_page .= empty($index_page) ? $lang_browser : "/$lang_browser";
				}
				else {
					/* check and set the uri identifier to the default value */
				$index_page .= empty($index_page) ? $default_abbr : "/$default_abbr";
				}
                
                if (strlen($lang_abbr) == 2) {
                    
                    /* remove invalid abbreviation */
                    $URI->uri_string = preg_replace("|^\/?$lang_abbr|", '', $URI->uri_string);
                }
                
                /* redirect */
                header('Location: '.$config['base_url'].$index_page.$URI->uri_string);
                exit;
            }

            /* set the language_abbreviation cookie */                
            $IN->set_cookie('user_lang', $default_abbr, $config['sess_expiration']);
        }
        
        log_message('debug', "Language_Identifier Class Initialized");
    }
	

	// get current language
	// ex: return 'en' if language in CI config is 'english' 
	function lang()
	{
		global $CFG;        
		$language = $CFG->item('language');

		$lang = array_search($language, $CFG->config['lang_uri_abbr']);
		if ($lang)
		{
			return $lang;
		}

		return NULL;    // this should not happen
	}
	
}
/* translate helper */
function t($line, $args = NULL) {
    global $LANG;
    if (!$args) {

        return ($t = $LANG->line($line)) ? $t : $line;

    } elseif (is_string($args)) {

        return ($t = $LANG->line($line)) ? sprintf($t, $args) : $line;
    
    } elseif (is_array($args)) {
    
        return ($t = $LANG->line($line)) ? vsprintf($t, $args) : $line;
    
    }
}

