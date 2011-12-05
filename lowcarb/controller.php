<?php if(!BOOT) exit("No direct script access.");

  /**
   * 
   * ✧ lowcarb
   *   super-light php blog framework
   * 
   *   Controller
   * 
   *   autoloaded
   * 
   */
  
  class Controller {
    
    private $model, $url;
    
    /**
     *  constructor
     * 
     */
    function __construct($model, $url) {
      
      $this->model = $model;
      $this->url = $url;
      
    }
    
    public function index() {
            
      $articles = $this->model->articles->select();
      
      $this->_parse_date($articles);
      
      $this->view('main',array("articles"=>$articles));
      
    }
    
    public function on($name) {
      
      $this->model->articles->process_name($name);
      
      $articles = $this->model->articles->select(array("name" => $name));
      
      $this->_parse_date($articles);
      
      $this->view('main', array("articles"=>$articles));
      
    }
    
    public function write() {
      
      $this->model->auth->filter(PERMISSION_ELEVATED);
      
      $errors = array();
      
      if( $this->model->post->sent() ) {
       
        if( !$this->model->post->title ) array_push($errors, "This post did not have a title.");
        if( !$this->model->post->content ) array_push($errors, "This post did not have any content.");
       
        if( empty($error) ) {

          $data = $this->model->post->get();
          $name = $this->model->post->title;
          $this->model->articles->process_name($name);
          
          $data["name"] = $name;
          
          $this->model->articles->insert($data);
          
          header("Location: /");

        }
        
      }
      
      $data = array(
        "title" => $this->model->post->title,
        "content" => $this->model->post->content
      );
      
      $this->view('write',$data,$errors);
      
    }
    
    public function error() {
      
      echo "404 Error. Ain't no such page, sorry.";
      
    }
    
    private function view($view, $data = array(), $errors = array()) {
      
      include("lowcarb/view/".$view.".php");
      
    }
    
    private function _parse_date(&$articles) {
      foreach($articles as &$article) {
        $t = strtotime($article['date']);
        $article['date'] = date('d M Y', $t);
      }
    }
    
  }

?>