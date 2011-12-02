<?php if(!BOOT) exit("No direct script access.");

  /**
   * 
   * ✧ lowcarb
   *   super-light php blog framework
   * 
   *   Input
   * 
   *   autoloaded
   * 
   */

  class Input {
    
    private $data;
    
    /**
     * construct input class
     *
     * @param mixed $data 
     * @author Tom Ashworth
     */
    function __construct($data) {
      
      $this->data = $data;
      
    }
    
    /**
     * get posted data
     *
     * @param mixed $name 
     * @return cleaned data, or null
     * @author Tom Ashworth
     */
    public function __get($name) {
      if( array_key_exists($name, $this->data) ) {
        return $this->_clean($this->data[$name]);
      }
      return null;
    }
   
    /**
     * clean post or get data
     *
     * @param mixed $data 
     * @return data
     * @author Tom Ashworth
     */
    private function _clean($data) {
      
      if( is_array($data) ) {
        
        foreach($data as &$ob) {
          $ob = $this->_clean($ob);
        }
        
      } else {
        
        $data = filter_var($data, FILTER_SANITIZE_STRING);
        
      }
      
      return $data;
      
    }
    
  }
  
?>