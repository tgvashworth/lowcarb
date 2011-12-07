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
    
    private $model, $url, $uri;
    
    /**
     *  constructor
     * 
     */
    function __construct($model, $url, $uri) {
      
      $this->model = $model;
      $this->url = $url;
      $this->uri = $uri;
      
    }
    
    public function index() {
            
      $articles = $this->model->articles->select();
      
      $this->_process_articles($articles);
      
      $this->view('main',array("articles"=>$articles));
      
    }
    
    public function on($name) {
      
      $this->model->articles->process_name($name);
      
      $articles = $this->model->articles->select(array("name" => $name));
      
      $this->_process_articles($articles);
      
      $this->view('main', array("articles"=>$articles));
      
    }
    
    private function _process_articles(&$articles) {
      
      $this->_parse_date($articles);
      
      $this->_parse_minidown($articles);
      
    }
    
    public function authenticate() {
      
      $errors = array();
      
      // Has the user tried to log in?
      if( $this->model->post->sent() ) {
        
        // Missing information errors
        if( !$this->model->post->name ) array_push($errors, "Please supply your name.");
        if( !$this->model->post->password ) array_push($errors, "Please supply a password.");

        if( empty($errors) ) {

          // Try to authenticate user
          if( $this->model->auth->user($this->model->post->name, $this->model->post->password) ) {
            
            header("Location: " . $this->uri->string());
            
          }
          
          // Error :|  
          array_push($errors, "Name & password not recognised.");
            
        }

      }

      $data = array(
        "name" => $this->model->post->name
      );
      
      // Show login form
      $this->view('login',$data, $errors);
        
    }
    
    public function write() {
      
      if( ! $this->model->auth->filter(PERMISSION_ELEVATED, false) ) {
        $this->authenticate();
      }
      
      $errors = array();
      
      if( $this->model->post->sent() ) {
       
        if( !$this->model->post->title ) array_push($errors, "This post did not have a title.");
        if( !$this->model->post->content ) array_push($errors, "This post did not have any content.");
       
        if( empty($errors) ) {

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
        "content" => $this->model->post->content,
        "action" => "write"
      );
      
      $this->view('write',$data,$errors);
      
    }
    
    public function edit($name) {
      
      if( ! $this->model->auth->filter(PERMISSION_ELEVATED, false) ) {
        $this->authenticate();
      }
      
      $errors = array();
      
      if( $this->model->post->sent() ) {
       
        if( !$this->model->post->title ) array_push($errors, "This post did not have a title.");
        if( !$this->model->post->content ) array_push($errors, "This post did not have any content.");
       
        if( empty($errors) ) {

          $data = $this->model->post->get();
          $name = $this->model->post->title;
          $this->model->articles->process_name($name);
          
          $data["name"] = $name;
          
          $this->model->articles->update($data);
          
          header("Location: /");

        }
        
      }
      
      $this->model->articles->process_name($name);
      
      $articles = $this->model->articles->select(array("name" => $name));
            
      $data = array(
        "title" => $articles[0]['title'],
        "content" => $articles[0]['content'],
        "id" => $articles[0]['id'],
        "action" => "edit"
      );
      
      $this->view('write',$data,$errors);
      
    }
    
    public function out() {
      
      $this->model->auth->out();
      
      header("Location: /");
      
    }
    
    public function error() {
      
      echo "404 Error. Ain't no such page, sorry.";
      
    }
    
    private function view($view, $data = array(), $errors = array()) {
      
      include("lowcarb/view/layout.php");
      
      exit();
      
    }
    
    private function _parse_minidown(&$articles) {
      foreach($articles as &$article) {
        $article['content'] = $this->model->md->out($article['content']);
      }
    }
    
    private function _parse_date(&$articles) {
      foreach($articles as &$article) {
        $t = strtotime($article['date']);
        $article['date'] = date('d M Y', $t);
      }
    }
    
  }

?>