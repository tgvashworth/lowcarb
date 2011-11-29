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
    
    private $model;
    
    /**
     *  constructor
     * 
     */
    function __construct($model) {
      
      $this->model = $model;
      
    }
    
    public function index() {
            
      $articles = $this->model->articles->select();
      
      $this->view($articles);
      
    }
    
    public function on($name) {
      
      $this->model->articles->_process_name($name);
      
      $articles = $this->model->articles->select(array("name" => $name));
      
      $this->view($articles);
      
    }
    
    public function error() {
      
      echo "404 Error. Ain't no such page, sorry.";
      
    }
    
    private function view($articles) {
      
      include("lowcarb/view/main.php");
      
    }
    
  }

?>