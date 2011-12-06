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
     * get all posted data
     *
     * @param mixed $name 
     * @return cleaned data, or null
     * @author Tom Ashworth
     */
    public function get() {
      return $this->_clean($this->data);
    }
    
    /**
     * get all posted data
     *
     * @param mixed $name 
     * @return cleaned data, or null
     * @author Tom Ashworth
     */
    public function sent() {
      return !empty($this->data);
    }
    
    /**
     * get specific posted data
     *
     * @param mixed $name 
     * @return cleaned data, or null
     * @author Tom Ashworth
     */
    public function __get($name) {
      if( array_key_exists($name, $this->data) ) {
        return $this->_clean($this->data[$name]);
      }
      return false;
    }
    
    /**
     * check data was posted
     *
     * @param mixed $name 
     * @return boolean
     * @author Tom Ashworth
     */
    public function __isset($name) {
      if( array_key_exists($name, $this->data) ) {
        return true;
      }
      return false;
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
        
        $bad = array("script", "object", "embed");
        
        foreach($bad as $tag) {
          $data = str_replace(array("<".$tag, "</".$tag.">"), '', $data);
        }
        
      }
      
      return $data;
      
    }
    
  }
  
?>