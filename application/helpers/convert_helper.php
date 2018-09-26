<?php
if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

if ( ! function_exists('date_cvt'))
{
	/**
	 *	Retourne la date "$date" en chiffres et lettres
	 * ou au format 00/00/0000
	 * en fonction de la langue "$lang"
	 * 
	 * $date = date au format BDD   2017/06/17
	 * $lang = langue souhaitée   "en", "fr" ex: $this->lang->lang()
	 * 
	 * @param type $date
	 * @param string $lang
	 * @param bool $letters
	 * @return string
	 */
	function date_cvt($date, $lang, $letters = TRUE): string
	{
		if($letters){ // Format Chiffres et lettres
			// English
			if($lang == 'en')
			{
				return $date = date_format(new DateTime($date),'D, M j Y');

			} else // French
			{
				$joursem = array('Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam');
				$moislettre = array('', 'Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc');

				$date = date_format( new DateTime($date),'j/n/Y');

				// extraction des jour, mois, an de la date
				list($jour, $mois, $annee) = explode('/', $date);
				// calcul du timestamp
				$timestamp = mktime (0, 0, 0, $mois, $jour, $annee);
				// affichage du jour de la semaine
				$jourS = $joursem[date("w",$timestamp)];
				$moisL = $moislettre[$mois];

				return $jourS . ', ' . $jour . ' ' . $moisL . ' ' . $annee;
			}
		} else // Format chiffres
		{
			if($lang == 'fr') { // French
				$date = date_format(new DateTime($date),'d/m/Y');
				
				return $date;
			}
			// English
			return $date = date_format(new DateTime($date),'m/d/Y');
		}
	}
}

if ( ! function_exists('speed_cvt'))
{
	/**
	 *	Renvoie la vitesse "$speed" en "Km/h"
	 * ou la converti en Knots "Kts"
	 * en fonction de la langue "$lang"
	 * 
	 * @param type $speed
	 * @param type $lang
	 * @return type string
	 */
	function speed_cvt($speed, string $lang): string
	{
		if($lang == 'en'){
			$speed /= 1.852;
			return round($speed) . " Kts";
		} else {
			return $speed . ' Km/h';
		}
	}
}

if ( ! function_exists('range_cvt'))
{
	/**
	 * 	Renvoie l'autonomie "$range" en "Km"
	 * ou la converti en Miles nautiques "nm"
	 * en fonction de la langue "$lang"
	 * 
	 * @param real $range
	 * @param string $lang
	 * @return string
	 */
	function range_cvt($range, string $lang, $suffix = TRUE): string
	{
		if($lang == 'en'){
			$suffix = $suffix === TRUE ? " nm" : "";
			$range /= 1.852;
			return round($range) . $suffix;
		} else {
			$suffix = $suffix === TRUE ? " Km" : "";
			return $range . $suffix;
		}
	}
}



if ( ! function_exists('debug'))
{
	function debug($var, $mode = 1)
	{
		echo '<div style="position: relative; background-color: firebrick; padding: 13px; position: fixed; bottom: 0; z-index: 10000; width: 70%;">';
		$trace = debug_backtrace(); // la fonction debug_backtrace retourne un tableau ARRAY contenant des informations tel que la ligne et le fichier où est exécutée cette fonction
		$trace = array_shift($trace); // extrait la première valeur d'un tableau ARRAY et la retourne. En raccourcissant le tableau et réordonnant les éléments du tableau.
		echo '<p style="line-height: 25px; margin: 0; color: beige; font-weight: 400;">Debug demandé dans le fichier: <strong>' . $trace['file'] . '</strong> à la ligne: <strong>' . $trace['line'] . '</strong></p><small style="position: absolute; right: 20px; top:15px; color: beige; cursor: pointer;" onclick="var s=document.getElementById(\'dumpcontent\'); s.style.display = \'none\';">{ CACHER }</small><small style="position: absolute; right: 90px; top:15px; color: beige; cursor: pointer;" onclick="var s=document.getElementById(\'dumpcontent\'); s.style.display = \'block\';">{ VOIR }</small>';
		if($mode === 1)
		{
			echo '<pre id="dumpcontent" style="display: none; background-color: #333;padding: 2rem 1rem 3rem 1rem; color: beige; max-height: 400px; overflow: auto;">'; var_dump($var); echo '</pre>';
		}
		else {
			echo '<pre id="dumpcontent" style="display: none; background-color: #222; color: beige; max-height: 400px; overflow: auto;">'; print_r($var); echo '</pre>';
		}
		echo '</div>';
	}
}
if ( ! function_exists('accord_image'))
{
	/****** redimensionnement des images ******/
	function accord_image($source, $lar = 300, $hau = 200)
	{   
		// Je renomme le fichier de sortie
		$explode_src = explode('.', $source);
		$src_name = $explode_src[0];
		$renamed = $src_name . time() . '.jpg';

		// je récupère le type mime
		$mime = mime_content_type('../' . $source);
		$explode_mime = explode('/', $mime);
		$ext = $explode_mime[count($explode_mime) - 1];

		$image_create = 'imagecreatefrom' . $ext; // détermine le nom de la function en fonction du mime type du fichier
		$largeur = $lar;// définition des nouvelles valeurs 
		$hauteur = $hau;


		$image = $image_create('../' . $source);
		$taille = getimagesize('../' . $source);
		$sortie = imagecreatetruecolor($largeur,$hauteur);

		$coef = min($taille[0]/$largeur,$taille[1]/$hauteur);

		$deltax = $taille[0]-($coef * $largeur);
		$deltay = $taille[1]-($coef * $hauteur);

		imagecopyresampled($sortie,$image,0,0,$deltax/2,$deltay/2,$largeur,$hauteur,$taille[0]-$deltax,$taille[1]-$deltay);

		imagejpeg($sortie, '../' . $renamed, 100);

		/*
		  Libération de la mémoire allouée aux deux images (source et nouvelle).
		*/
		imagedestroy($sortie);
		imagedestroy($image);

		unlink('../' . $source); // Je supprime l'image chargée temporairement

		return $renamed;
	}
}
