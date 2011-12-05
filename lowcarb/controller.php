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
      
      $this->_parse_date($articles);
      
      $this->view('main',array("articles"=>$articles));
      
    }
    
    public function on($name) {
      
      $this->model->articles->process_name($name);
      
      $articles = $this->model->articles->select(array("name" => $name));
      
      $this->_parse_date($articles);
      
      $this->view('main', array("articles"=>$articles));
      
    }
    
    public function authenticate() {
      
      // Filter non-authenticatd users
      if( ! $this->model->auth->filter(PERMISSION_ELEVATED, false) ) {
        
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
        
      } else {
        
        $this->write();
        
      }
      
    }
    
    public function write() {
      
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
        "content" => $this->model->post->content
      );
      
      $this->view('write',$data,$errors);
      
    }
    
    public function error() {
      
      echo "404 Error. Ain't no such page, sorry.";
      
    }
    
    private function view($view, $data = array(), $errors = array()) {
      
      include("lowcarb/view/layout.php");
      
    }
    
    private function _parse_date(&$articles) {
      foreach($articles as &$article) {
        $t = strtotime($article['date']);
        $article['date'] = date('d M Y', $t);
      }
    }
    
  }

?>