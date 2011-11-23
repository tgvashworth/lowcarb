<?php

  /**
   * 
   * ✧ lowcarb
   *   super-light php blog framework
   * 
   *   DB
   * 
   *   autoloaded
   * 
   */
  
  class DB {
    
    private $link, $db, $config, $connected = false;
    
    /**
     *  constructor
     * 
     */
    function __construct($config, $force = false) {
      
      if( !$this->check_config($config) ) {
        exit("Malformed DB config - host, user & password required.");
      }
      
      $this->config = $config;
      
      if( $force ) {
        $this->connect();
      }
      
    }
    
    /**
     * connect to database
     *
     * this is performed last-minute, and might never be used on a page
     */
    public function connect() {
      
      $this->link = mysql_connect($this->config["host"], $this->config["user"], $this->config["password"])
                      or die("Could not establish connection to database.");
      $this->db = mysql_select_db($this->config["db"], $this->link)
                      or die("Could not attach to database.");
      
    }
    
    /**
     * check config for essential items
     *
     */
    private function check_config($config) {
      
      $required = array("host", "user", "password", "db");
      
      foreach( $required as $key ) {
        if( !array_key_exists($key, $config) ) {
          return false;
        }
      }
      
      return true;
      
    }
    
  }

?>