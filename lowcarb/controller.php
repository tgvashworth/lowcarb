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
    
    public function index($year, $month) {
      
      print_r($year . "/" . $month);
      
      $result = $this->model->articles->select();
      
      echo "<br/>";
      print_r($result);
      echo "<br/>";
      
      foreach($result as $article) {
        echo $article['title'];
      }
      
    }
    
    public function error() {
      
      echo "404 Error. Ain't no such page, sorry.";
      
    }
    
  }

?>