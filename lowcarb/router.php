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
    public function match($uri) {
      
      if( $uri == '' ) return $this->routes['index'];
      
      $uri = preg_replace('\d+',':num',$segment);
      
      return $uri;
      
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