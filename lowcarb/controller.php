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
      
      $this->view('main',array("articles"=>$articles));
      
    }
    
    public function on($name) {
      
      $this->model->articles->_process_name($name);
      
      $articles = $this->model->articles->select(array("name" => $name));
      
      $this->view('main', array("articles"=>$articles));
      
    }
    
    public function write() {
                  
      if( $this->model->post->test == 1 ) {
       
        // Data was posted
        
      }
      
      $this->view('write');
      
    }
    
    public function error() {
      
      echo "404 Error. Ain't no such page, sorry.";
      
    }
    
    private function view($view, $data = array()) {
      
      include("lowcarb/view/".$view.".php");
      
    }
    
  }

?>