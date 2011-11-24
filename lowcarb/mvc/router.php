<?php

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
    function __construct($uri) {
      
      $this->uri = $uri;
      
    }
    
    /**
     *  adds a route
     * 
     */
    public function route($uri, $view) {
      
      $uri = trim($uri);
      
      if( $uri == '' ) {
        $uri = 'index';
      }
      
      if( isset($routes[$uri]) ) {
        exit("Attempted route override.");
      }
      
      $routes[$uri] = array();
      $routes[$uri]["view"] = $view;
            
    }
    
    
  }
  
?>