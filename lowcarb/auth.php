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
     * set up auth library
     *
     * @param string $salt 
     * @param string $table 
     * @param string $db 
     * @author Tom Ashworth
     */
    function __construct($salt, $table, $db) {
      
      $this->salt = $salt;
      $this->table = $table;
      $this->db = $db;
      
    }
    
    /**
     * attempt to log user in
     *
     * @param string $name 
     * @param string $password 
     * @return bool
     * @author Tom Ashworth
     */
    public function user($name, $password) {
      
      if( !$this->started ) {
        $this->_start();
      }
      
      $name = preg_replace("/[^a-zA-Z]/i", '', $name);
      $password = $this->_encrypt($password);
      
      error_log("Trying " . $password);
      
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
    
    /**
     * check if user has require permissions
     *
     * @param string $level 
     * @param string $redirect 
     * @return bool
     * @author Tom Ashworth
     */
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
    
    /**
     * log user out
     *
     * @return void
     * @author Tom Ashworth
     */
    public function out() {
      $this->_end(false);
      error_log("Logout level: " . $this->session->level);
    }
    
    /**
     * begin new sessions
     *
     * @return void
     * @author Tom Ashworth
     */
    private function _start() {
      $this->session = new Session();
      
      error_log("Start level: " . $this->session->level);
      
      if( !$this->session->sid ) $this->session->sid = sha1(date('r') . time() . microtime());
      if( !$this->session->level ) $this->session->level = 0;
    }
    
    /**
     * reset authentication session data, redirect home if required
     *
     * @return void
     * @author Tom Ashworth
     */
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
    
    /**
     * encrypt string
     *
     * @param string $string 
     * @return string
     * @author Tom Ashworth
     */
    private function _encrypt($string) {
      return sha1($string . $this->salt);
    }
    
  }
  
?>