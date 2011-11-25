<?php if(!BOOT) exit("No direct script access.");

  /**
   * 
   * ✧ lowcarb
   *   super-light php blog framework
   * 
   *   Router
   * 
   *   autoloaded
   * 
   */

  class Router {
    
    private $routes = array();
    
    private $uri;
    
    /**
     *  constructor
     * 
     */
    function __construct($routes) {
      
      foreach($routes as $uri => $function) {
        $this->_add($uri, $function);
      }
      
    }
    
    /**
     * matches uri to callback
     *
     */
    public function match($segments) {
      
      print_r($segments);
      
      if( empty($segments) ) return $this->routes['index'];
      
      foreach($segments as &$segment) {
        
        $segment = trim(preg_replace('/\d+/i',':num',$segment), '/');
        
      }
      
      if( $segments[0] !== ':num' ) {
        return $this->_get_route($segments[0]);
      }
      
      $uri = implode('/', $segments);
      
      print_r("URI: " . $uri);
      
      return $this->_get_key($uri);
      
    }
    
    /**
     *  gets route value
     * 
     */
    private function _get_route($key) {
      
      if( array_key_exists($key, $this->routes) ) {
        return $this->routes[$key];
      } else {
        exit("Route " . $key . " not found.");
      }
      
    }
    
    /**
     *  adds a route
     * 
     */
    private function _add($uri, $function) {
      
      $uri = trim($uri);
      
      if( $uri == '' ) {
        $uri = 'index';
      }
            
      if( isset($this->routes[$uri]) ) {
        exit("Attempted route override.");
      }
      
      $this->routes[$uri] = $function;
            
    }
    
    
  }
  
?>