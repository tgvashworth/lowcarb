<?php if(!BOOT) exit("No direct script access.");

  /**
   * 
   * ✧ lowcarb
   *   super-light php blog framework
   * 
   *   Session
   * 
   *   autoloaded
   * 
   */

  class Session {
    
    
    /**
     *  sets data property
     * 
     */ 
    public function __set($name, $value) {
      if( !array_key_exists($name, $_SESSION) ) {
        $_SESSION[$name] = $value;
      }
    }
    
    /**
     *  gets data property or null
     * 
     */
    public function __get($name) {
      if( array_key_exists($name, $_SESSION) ) {
        return $_SESSION[$name];
      }
      return null;
    }
    
    
  }
  
?>