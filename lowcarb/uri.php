<?php if(!BOOT) exit("No direct script access.");

  /**
   * 
   * ✧ lowcarb
   *   super-light php blog framework
   * 
   *   URI
   * 
   *   autoloaded
   * 
   */
  
  class URI {
    
    private $uri = array();
    
    private $uri_string = "", $prefix = "";
    
    /**
     *  constructor
     * 
     *  builds array of cleaned request uri
     *
     */
    function __construct($prefix) {
      
      $this->prefix = $prefix;
      
      $this->_parse_uri();
      
    }
    
    /**
     *  returns uri array
     *  @public
     *
     */
    public function segments() {
      
      return $this->uri;
      
    }
    
    /**
     *  returns uri string
     *
     */
    public function string() {
      
      return $this->uri_string;
      
    }
    
    /**
     *  parses request uri into array
     * 
     */
    private function _parse_uri() {
      
      $str = $_SERVER['REQUEST_URI'];
      
      $str = str_replace($this->prefix, '', $str);
      
      if( isset($str) && $str !== '/' ) {
        
        if( strpos($str, '?') !== false) {
          $str = strstr($str, '?', true);
        }
        
        $str = $this->_clean($str);
        
        $this->uri_string = $str;
        
        $this->uri = explode('/', substr($str, 1));
        
      }
      
    }
    
    /**
     *  cleans url string
     * 
     */
    private function _clean($str) {
      
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