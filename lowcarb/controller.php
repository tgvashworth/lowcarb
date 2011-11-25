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
    
    /**
     *  constructor
     * 
     */
    function __construct() {
      
    }
    
    public function index($year, $month) {
      
      print_r($year . "/" . $month);
      
    }
    
    public function error() {
      
      echo "404 Error. Ain't no such page, sorry.";
      
    }
    
  }

?>