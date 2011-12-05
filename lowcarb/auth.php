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
    
    private $session, $salt, $table, $db, $started = false;
    
    /**
     *  constructor
     * 
     */
    function __construct($salt, $table, $db) {
      
      $this->salt = $salt;
      $this->table = $table;
      $this->db = $db;
      
    }
    
    public function user($name, $password) {
      
      if( !$this->started ) {
        $this->_start();
        
      }
      
      $name = preg_replace("/[^a-zA-Z]/i", '', $name);
      $password = $this->_encrypt($password . $this->salt);
      
      $sql = " SELECT * FROM " . $this->table
           . " WHERE name='" . mysql_real_escape_string($name) . "'"
           . " AND password='" . $password . "'";
                 
      $result = $this->db->query($sql);
      $result = $this->_process_result($result);
     
      if( count($result) > 0 ) {
        
        $this->session->level = $result[0]['level'];
        error_log("Logged in to level: " . $this->session->level);
        error_log('$_SESSION has: ' . $_SESSION['level']);
        return true;
        
      }
      
      return false;
      
    }
    
    public function filter($level, $redirect) {
      
      if( !$this->started ) {
        $this->_start();
      }
      
      if( $this->session->level < $level ) {
        error_log("Session level too low.");
        error_log("Session level: " . $this->session->level);
        error_log("Required: " . $level);
        $this->_end($redirect);
        return false;
      }
      
      error_log("Session level OK.");
      error_log("Session level: " . $this->session->level);
      error_log("Required: " . $level);
      
      return true;
      
    }
    
    public function out() {
      $this->_end(false);
      error_log("Logout level: " . $this->session->level);
    }
    
    private function _start() {
      $this->session = new Session();
      
      error_log("Start level: " . $this->session->level);
      
      if( !$this->session->sid ) $this->session->sid = sha1(date('r') . time() . microtime());
      if( !$this->session->level ) $this->session->level = 0;
    }
    
    private function _end($redirect) {
      if( !$this->started ) {
        $this->_start();
      }
      $this->session->level = 0;
      error_log("Logged out to level: " . $this->session->level);
      error_log('$_SESSION has: ' . $_SESSION['level']);
      if( $redirect ) header('Location: /');
    }
    
    /**
     * process sql query result to array
     *
     */
    private function _process_result($result) {
      
      $temp = array();
      
      while($row = mysql_fetch_array($result)) {
        array_push($temp, $row);
      }
      
      return $temp;
      
    }
    
    private function _encrypt($string) {
      
      return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->salt), $string, MCRYPT_MODE_CBC, md5(md5($this->salt))));
      
    }
    
    
  }
  
?>