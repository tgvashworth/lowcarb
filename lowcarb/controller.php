<?php if(!BOOT) exit("No direct script access.");

  /**
   * 
   * ✧ lowcarb
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
      
      $this->_process_data($articles);
      
      $this->view('main',array("articles"=>$articles,"showintro"=>true));
      
    }
    
    public function on($name) {
      
      $this->model->articles->process_name($name);
      
      $articles = $this->model->articles->select(array("name" => $name));
      
      $this->_process_data($articles);
      
      $comments = $this->model->comments->select(array("fk_article" => $articles[0]['id']), array(), true);
      
      $this->_process_data($comments);
      
      $data = array(
        "articles"=>$articles,
        "showcomments"=>true,
        "comments"=>$comments,
        "title"=>' on ' . $articles[0]['title']
      );
      
      $this->view('main',$data);
      
    }
    
    private function _process_data(&$data) {
      
      $this->_parse_date($data);
      
      $this->_parse_minidown($data);
      
    }
    
    public function authenticate($callback = '') {
      
      $errors = array();
      
      // Has the user tried to log in?
      if( $this->model->post->sent() ) {
        
        // Missing information errors
        if( !$this->model->post->name ) array_push($errors, "Please supply your name.");
        if( !$this->model->post->password ) array_push($errors, "Please supply a password.");

        if( empty($errors) ) {

          // Try to authenticate user
          if( $this->model->auth->user($this->model->post->name, $this->model->post->password) ) {
            
            header("Location: " . $this->url . $callback);
            
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
        $this->authenticate('write');
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
          
          if( $this->model->articles->check_name($name) ) {
            
            $this->model->articles->insert($data);

            header("Location: " . $this->url );
            
          }
          
          array_push($errors, "This post title is already in use.");

        }
        
      }
      
      $data = array(
        "title" => $this->model->post->title,
        "content" => $this->model->post->content,
        "action" => "write",
        "mode" => "write"
      );
      
      $this->view('write',$data,$errors);
      
    }
    
    public function edit($name) {
      
      if( ! $this->model->auth->filter(PERMISSION_ELEVATED, false) ) {
        $this->authenticate('edit/'.$name);
      }
      
      $errors = array();
      
      if( $this->model->post->sent() ) {
       
        if( !$this->model->post->title ) array_push($errors, "This post did not have a title.");
        if( !$this->model->post->content ) array_push($errors, "This post did not have any content.");
       
        if( empty($errors) ) {

          $data = $this->model->post->get();
          $newname = $this->model->post->title;
          $this->model->articles->process_name($newname);
          
          if( $this->model->articles->check_name($newname) || $newname == $name ) {
            
            $data['name'] = $newname;
            
            $this->model->articles->update($data);

            header("Location: " . $this->url);
            
          }
          
          array_push($errors, "This post title is already in use.");

        }
        
      }
      
      $this->model->articles->process_name($name);
      
      $articles = $this->model->articles->select(array("name" => $name));
            
      $data = array(
        "title" => $articles[0]['title'],
        "content" => $articles[0]['content'],
        "id" => $articles[0]['id'],
        "action" => "edit/" . $name,
        "mode" => "edit"
      );
      
      $this->view('write',$data,$errors);
      
    }
    
    public function comment($name) {
      
      $errors = array();
      
      if( $this->model->post->sent() ) {
       
        if( !$this->model->post->name ) array_push($errors, "Please provide your name.");
        if( !$this->model->post->content ) array_push($errors, "Please provide some content.");
       
        if( empty($errors) ) {

          $data = $this->model->post->get();
          
          $this->model->comments->insert($data);

          header("Location: " . $this->url . "on/" . $name);
            
        }
        
      }
      
      $flash = array(
        "data" => array(
          "name" => $this->model->post->name,
          "content" => $this->model->post->content
        ),
        "errors" => $errors
      );
      
      header("Location: " . $this->url . "on/" . $name);
      
    }
    
    public function delete($name) {
      
      if( ! $this->model->auth->filter(PERMISSION_ELEVATED, false) ) {
        $this->authenticate('delete/'.$name);
      }
      
      $this->model->articles->delete(array("name"=>$name));
      
      header("Location: " . $this->url);
      
    }
    
    public function out() {
      
      $this->model->auth->out();
      
      header("Location: " . $this->url);
      
    }
    
    public function error() {
      
      $this->view('error',$data,$errors);
      
    }
    
    private function view($view, $data = array(), $errors = array()) {
      
      if( $this->model->auth->filter(PERMISSION_ELEVATED, false) ) {
        
        $editarticles = $this->model->articles->select();
        $this->_process_data($editarticles);
        
        $data['editarticles'] = $editarticles;
        
        $data["showadmin"] = true;
        
      }
      
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