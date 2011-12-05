<?php if(!BOOT) exit("No direct script access.");

  /**
   * 
   * ✧ lowcarb
   *   super-light php blog framework
   * 
   *   Auth
   * 
   *   autoloaded
   * 
   */

  class Auth {
    
    private $session, $table, $db, $started = false;
    
    /**
     *  constructor
     * 
     */
    function __construct($table, $db) {
      
      $this->table = $table;
      $this->db = $db;
      
    }
    
    public function filter($level) {
      
      if( !$this->started ) {
        $this->_start();
      }
      
      print_r($this->session->sid);
      exit();
      
    }
    
    private function _start() {
      session_start();
      $this->session = new Session();
      
      $this->session->sid = sha1(date('r') . time() . microtime());
    }
    
    
  }
  
?>