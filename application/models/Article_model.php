<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AircraftCrew_model
 *
 * @author Edison
 */

class Article_model extends CI_Model {
    
    private $table = 'article';
    
    public function __construct() {
        parent::__construct();
        //Relation tables
        $this->load->model('ArticleCategory_model', 'catMgr');

	}
	
    public function count($param = array())
	{
		if(is_array($param) && !empty($param)){
			foreach ($param as $key => $value) {
				if($value != ""){
					$this->db->where($key, $value);
				}
			}
		}
        return (int) $this->db->count_all_results($this->table);
	}
    
	public function fetch_article($limit, $start, $cat = "") {
		if($cat != ""){
			$this->db->where('article_category_id', $cat);
		}
        $query = $this->db->order_by("article_date desc")->limit($limit, $start)->get($this->table);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$row->category = $this->catMgr->getCategory($row->article_category_id);
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
     /**
	 * 
	 * 
	 * @return array
	 */
	public function articleList(string $order = "article_date desc",
								array $limit = array('limit' => 99999, 'start' => 0),
								array $where = array()) :array
	{
		$this->db->where($where);

		if(!empty($result = $this->db->order_by($order)->limit($limit['limit'], $limit['start'])->get($this->table)->result()))
		{
			foreach ($result as $row)
			{
				$row->category = $this->catMgr->getCategory($row->article_category_id);
			}
		}
		
        return $result;
    }
        
     /**
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function getArticle(int $id)
	{
        $getar = $this->db->get_where($this->table, array('id' => $id))
                ->row();
		$getar->category = $this->catMgr->getCategory($getar->article_category_id);
		return $getar;
    }
    
     /**
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function verifId(int $id):bool
	{
        if (empty ($this->db->get_where($this->table, array('id' => $id))->result()))
        {
            return false;
        }
        return true; 
    }
	/**
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function entryExists(array $param):bool
	{
        if (empty ($this->db->get_where($this->table, $param)->result()))
        {
            return false;
        }
        return true; 
    }
        /**
	 * 
	 * @param int $id
	 * @return bool
	 */
    public function deleteArticle(int $id):bool
	{
        return $this->db->where('id', $id)
                        ->delete($this->table);
    }
        /**
	 * 
	 * @param int $id
	 * @param bool $upload
	 * @return bool
	 */
    public function editArticle($id, bool $upload):bool
	{
        $data = array(
            
            'author' => $this-> input -> post('author'),
//            'article_date' => date("Y-m-d"),
            'article_category_id' => $this-> input -> post('article_category_id'),
            'title_en' => $this -> input -> post('title_en'),
            'title_fr' => $this -> input -> post('title_fr'),
			'description_en' => $this -> input -> post('description_en'),
            'description_fr' => $this -> input -> post('description_fr'),
            'content_en' => $this -> input -> post('content_en'),
            'content_fr' => $this -> input -> post('content_fr'),
            
        );
		
		if($upload)
		{
			isset($this->upload->file_names['picture_1'])? $data['picture_1'] = "blog/" . $this->upload->file_names['picture_1']:"";
			isset($this->upload->file_names['picture_2'])? $data['picture_2'] = "blog/" . $this->upload->file_names['picture_2']:"";
		}
        
		if($id != null){
			return $this->db->where('id', $id)
							->update($this->table, $data);
		}
		
		$data['article_date'] = date("Y-m-d");
        return $this->db->insert($this->table, $data);
    }
}