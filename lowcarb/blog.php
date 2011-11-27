<?php if(!BOOT) exit("No direct script access.");

  /**
   * 
   * ✧ lowcarb
   *   super-light php blog framework
   * 
   *   Blog controller
   * 
   * 
   */
  
  class Blog extends Controller {
    
    /**
     *  constructor
     * 
     */
    function __construct() {
      
      parent::__construct();
      
    }
    
    public function index($year, $month) {
      
      echo $year . '/' . $month;
      
    }
    
  }

?>