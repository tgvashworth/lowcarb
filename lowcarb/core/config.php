<?php

  /**
   * 
   * ✧ lowcarb
   *   super-light php blog framework
   * 
   *   Config
   * 
   *   autoloaded
   * 
   */

  class Config {
    
    private $config = array();
  
    /**
     *  constructor
     * 
     */
    function __construct() {}
    
    /**
     *  sets config property
     * 
     */ 
    public function __set($name, $value) {
      $this->config[$name] = $value;
    }
    
    /**
     *  gets config property or null
     * 
     */
    public function __get($name) {
      if( array_key_exists($name, $this->config) ) {
        return $this->config[$name];
      }
      return null;
    }
  
  }
  
?>