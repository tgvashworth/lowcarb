<?php

  /**
   * 
   * ✧ lowcarb
   *   super-light php blog framework
   * 
   *   URI
   * 
   *   - autoloaded on startup
   * 
   */
  
  class URI {
    
    var $uri = array();
    
    var $uri_string = "";
    
    /**
     *  constructor
     * 
     *  builds array of cleaned request uri
     *
     */
    function __construct() {
      
      $this->_parse_uri();
      
    }
    
    /**
     *  returns uri array
     *  @public
     *
     */
    function segments() {
      
      return $this->uri;
      
    }
    
    /**
     *  parses request uri into array
     * 
     */
    function _parse_uri() {
      
      $str = $_SERVER['REQUEST_URI'];
      
      if( isset($str) && $str !== '/' ) {
        
        $str = $this->_clean($str);
        
        $this->uri_string = $str;
        
        $this->uri = explode('/', substr($str, 1));
        
      }
      
    }
    
    /**
     *  cleans url string
     * 
     */
    function _clean($str) {
      
      /** 
       * adapted from the CodeIgniter framework's URI class
       * i don't think i could write a better url cleaner 
       */
      if( $str == '' ) return $str;
      
      if ( ! preg_match("|^[".str_replace(array('\\-', '\-'), '-', preg_quote('a-z 0-9~%.:_\-/', '-'))."]+$|i", $str)) {
        
        exit("Disallowed characters in URI.");
        
      }
      
      $bad	= array('$', '(', ')', '%28', '%29');
      $good	= array('&#36;', '&#40;', '&#41;', '&#40;', '&#41;');

  		return str_replace($bad, $good, $str);
      
    }
    
  }

?>