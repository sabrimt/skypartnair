<?php


/**
 * Description of Blog
 *
 * @author Pierre-Antoine
 */

class Blog extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Article_model', 'artMgr');
		$this->layout->setTheme('default');
		$this->lang->load("blog_lang", $this->config->item('language'));
		$this->load->library("pagination");
	}

	private function countArticle($param = array()) {
		return (int) $this->artMgr->count($param);
	}

	public function index () {
		$this->listDisplay();
	}

	public function listDisplay($cat = "") {
		$this->session->set_userdata('article_category_id', $cat);
		
		$whereClause = array();

		if ($cat) {
			$whereClause['article_category_id'] = $cat;
		}

		$data = array();
		$data['nb_article'] = $this->countArticle($whereClause);

		if (!$cat) {

			$data['artitre'] = $this->artMgr->articleList("article_date desc", ['limit'=>1, 'start'=>0], $whereClause );
			$data['articles'] = $this->artMgr->articleList("article_date desc", ['limit'=>9, 'start'=>1], $whereClause );
			$data['voiraussi'] = $this->artMgr->articleList("article_date desc", ['limit'=>$data['nb_article'], 'start'=>10], $whereClause );
		
		} else {

			$data['articles'] = $this->artMgr->articleList("article_date desc", ['limit'=>9, 'start'=>0], $whereClause );
			$data['voiraussi'] = $this->artMgr->articleList("article_date desc", ['limit'=>$data['nb_article'], 'start'=>10], $whereClause );
			
		}

		$data['categos'] = $this->catMgr->categoryList();

//		debug($data['articles']);
		if(!empty($data['articles'])){
			foreach ($data['articles'] as $article) {
				$article->article_date = date_cvt($article->article_date, $this->lang->lang());
			}
    }
		
		
		$config = array();
		$config["base_url"] = base_url() . "blog/example";
		$config["total_rows"] = $this->artMgr->count(['article_category_id' => $cat])-10;
		$config["per_page"] = 8;
		$config["uri_segment"] = 2;
		$config['use_page_numbers'] = false;
		$config['full_tag_open'] = '';
		$config['full_tag_close'] = '';
		$config['first_link'] = '<i class="material-icons">&#xE5DC;</i>';
		$config['first_tag_open'] = '<li class="wave-effects">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '<i class="material-icons">&#xE5DD;</i>';
		$config['last_tag_open'] = '<li class="wave-effects">';
		$config['last_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="wave-effects">';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="wave-effects">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="red darken-5 active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li class="wave-effects">';
		$config['next_tag_close'] = '</li>';
		$config['next_link'] = '<i class="material-icons">&#xE5CC;</i>';
		$config['prev_tag_open'] = '<li class="wave-effects">';
		$config['prev_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="material-icons">&#xE5CB;</i>';
		$this->pagination->initialize($config);
		$page = 10;
		$data["results"] = $this->artMgr->fetch_article($config["per_page"], $page, $cat);

		if(!empty($data['results'])){
			foreach ($data['results'] as $article) {
				$article->article_date = date_cvt($article->article_date, $this->lang->lang());
			}
		}
				
		$data["links"] = $this->pagination->create_links();
	   
	   
		$this->layout->addJs("//lightwidget.com/widgets/lightwidget.js");
		$this->layout->addJs('blog');
		$this->layout->addCss('blog');
		$this->layout->addJs('animation');
		$this->layout->addCss('animation');

		
    if($this->input->post('ajax')) {
			$this->load->view('ciajaxpagination',$data);
		} 
    else {
			$this->layout->view('blog',$data);
		}
	}

	 public function displayArticle($id) {
		$data['article'] = $this->artMgr->getArticle($id);
		
		
		$cat=$data['article']->article_category_id;
		$whereClause = array(
			'article_category_id' => $cat,
		);

		$data['voiraussi'] = $this->artMgr->articleList("article_date desc", ['limit'=>10, 'start'=>0], $whereClause);
		$data['categos'] = $this->catMgr->categoryList();
		$this->layout->addJs('blog');
		$this->layout->addCss('blog');
		$this->layout->view('blog_article', $data);
	 }

	

		public function example() {
				$cat = $this->session->article_category_id;
				$param = array('article_category_id' => $cat);
						
				$config = array();
				$config["base_url"] = base_url() . "blog/example";
				$config["total_rows"] = $this->artMgr->count($param)-10;
				$config["per_page"] = 8;
				$config["uri_segment"] = 2;
				$config['use_page_numbers'] = false;
				$config['full_tag_open'] = '';
				$config['full_tag_close'] = '';
				$config['first_link'] = '<i class="material-icons">&#xE5DC;</i>';
				$config['first_tag_open'] = '<li class="wave-effects">';
				$config['first_tag_close'] = '</li>';
				$config['last_link'] = '<i class="material-icons">&#xE5DD;</i>';
				$config['last_tag_open'] = '<li class="wave-effects">';
				$config['last_tag_close'] = '</li>';
				$config['prev_tag_open'] = '<li class="wave-effects">';
				$config['prev_tag_close'] = '</li>';
				$config['next_tag_open'] = '<li class="wave-effects">';
				$config['next_tag_close'] = '</li>';
				$config['num_tag_open'] = '<li class="wave-effects">';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="red darken-5 active"><a>';
				$config['cur_tag_close'] = '</li>';
				$config['next_link'] = '<i class="material-icons">&#xE5CC;</i>';
				$config['prev_link'] = '<i class="material-icons">&#xE5CB;</i>';

				$this->pagination->initialize($config);
				
				$page = ($this->uri->segment(2)) ? $this->uri->segment(2)+10 : 0+10;
				$data["results"] = $this->artMgr->fetch_article($config["per_page"], $page, $cat);

				foreach ($data['results'] as $article) {
						$article->article_date = date_cvt($article->article_date, $this->lang->lang());
				}
				$data["links"] = $this->pagination->create_links();
				//sleep(1);
				
        if($this->input->post('ajax')) {
         		$this->load->view('ciajaxpagination',$data);
        }
    }

}



