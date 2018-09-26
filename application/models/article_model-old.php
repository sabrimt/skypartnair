<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Article_model
 * 
 *      ajouter_news($auteur, $titre, $contenu)
 *      editer_article($id_article, $titre = null, $contenu = null)
 *      supprimer_article($id_article)
 *      count($where = array())
 *      liste_article($nb = 10, $debut = 0)
 */

class Article_model extends CI_Model
{
	protected $table = 'article';
	
	/**
         *      Ajoute un article
	 *	@param string $auteur   L'auteur de la news
         *      @param string $titre    Le titre de la news
         *      @param string $contenu  Le contenu de la news
         *      @return bool            Le résultat de la requête
         *      
	 */
	public function ajouter_article($auteur, $titre, $contenu)
	{
            echo 'test model: ajout d article';
            return $this->db->set('auteur', $auteur)
                    ->set('titre', $titre)
                    ->set('contenu',	$contenu)
                    ->set('date_article', 'NOW()', false)
                    ->insert($this->table);
        }

	/**
	 *	Édite une news déjà existante
         *      @param integer $id_article   L'id de la news à modifier
         *      @param string $titre     Le titre de la news
         *      @param string $contenu    Le contenu de la news
         *      @return bool   le résultat de la requête
	 */
	public function editer_article($id_article, $titre = null, $contenu = null)
	{
            // Il n'y a rien à éditer
            if ($titre == null AND $contenu == null)
            {
                return false;
            }
            // Ces donnéses seront échapées
            if($titre != NULL)
            {
                $this->db->set('titre', $titre);
            }
            if($contenu != NULL)
            {
                $this->db->set('contenu', $contenu);
            }
            return $this->db->set('date_article', 'NOW()', false)
			->where('id', (int) $id_article)
			->update($this->table);
	}
	
	/**
	 *Supprime une news
         * 
         * @param integer $id_article  l'id de la news à modifier
         * return bool   le résultat de la requête
	 */
	public function supprimer_article($id_article)
	{
            return $this->db->where('id_article', (int) $id_article)
                    ->delete($this->table);
	}
	
	/**
	 *	Retourne le nombre d'article
         * 
         * @param array $where  Tableau associatif permettant de définir des conditions 
         * @return integer   Le nombre de news satisfaisant la condition	
         * 
         */
        
	public function count($where = array())
	{
		return (int) $this->db->where($where)
                        ->count_all_results($this->table);
                
	}
	/**
	 *	Retourne une liste de $nb dernières news
         * 
         * @param integer $nb  le nombre d'article
         * @param integer $debut  Nombre de news à sauter
         * @return objet   la liste de news
         * 
	 */
	public function liste_article($nb = 10, $debut = 0)
	{
            return $this ->db->select('*')
                    ->from($this->table)
                    ->limit($nb, $debut)
                    ->order_by('id_article','desc')
                    ->get()
                    ->result();
		
	}
}


/* End of file news_model.php */
/* Location: ./application/models/news_model.php */
