<?php if(!BOOT) exit("No direct script access.");

  /**
   * 
   * ✧ lowcarb
   *   super-light php blog framework
   * 
   *   Model
   * 
   *   autoloaded
   * 
   */

  class Model {
    
    private $query, $table;
    
    /**
     *  constructor
     * 
     */
    function __construct($table, $db = null) {
      
      if( !isset($table) ) {
        exit("Model created with no associated table.");
      }
      
      if( $db == null ) {
        exit("Model created with no database method.");
      }
      
      $this->table = trim($table);
      
      // this is a handle to a DB query function.
      // it does not care if the DB has been connected,
      // and so calling query("...SQL...") could actually
      // be forcing a DB connection, and then querying
      $this->db = $db;
      
    }
    
    /**
     * run select query 
     *
     */
    public function select($options = array(), $fields = array()) {
      
      $this->_process_fields($fields);
      
      $this->_process_options($options);
          
      $sql = "SELECT " . $fields
           . " FROM " . $this->table
           . " " . $options;
          
      $result = $this->db->query($sql);
      
      print $sql;
      
      return $this->_process_result($result);
      
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
     * process sql query fields
     *
     */
    private function _process_fields(&$fields) {
      
      if( empty($fields) || $fields[0] == "*" ) {
        $fields = "*";
      } else {
        $fields = implode(", ", $fields);
      }
      
    }
    
    /**
     * process sql query options
     *
     */
    private function _process_options(&$options) {
      
      $temp = "WHERE ";
      
      if( empty($options) ) {
        $options = "";
        return null;
      } else {
        $count = 0;
        foreach($options as $field => $value) {
          if($count > 0) {
            $temp .= " AND";
          }
          $temp .= " " . $field . "='" . mysql_real_escape_string(stripslashes($value)) . "'";
          $count += 1;
        }
      }
      
      $options = $temp;
      
    }
    
    /**
     * turn post title into stored name
     *
     */
    public function _process_name(&$name) {
      
      $name = strtolower(str_replace('%20', '-', $name));
      
    }
    
    
  }
  
?>