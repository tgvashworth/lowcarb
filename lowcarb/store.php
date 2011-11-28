<?php if(!BOOT) exit("No direct script access.");

  /**
   * 
   * ✧ lowcarb
   *   super-light php blog framework
   * 
   *   Store
   * 
   *   autoloaded
   * 
   */

  class Store {
    
    private $data = array();
  
    /**
     *  constructor
     * 
     */
    function __construct() {
      
    }
    
    /**
     *  sets data property
     * 
     */ 
    public function __set($name, $value) {
      
      $this->data[$name] = $value;
      
    }
    
    /**
     *  gets data property or null
     * 
     */
    public function __get($name) {
      if( array_key_exists($name, $this->data) ) {
        return $this->data[$name];
      }
      return null;
    }
  
  }
  
?>