<?php

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
    public function select($fields = array(), $options = array()) {
      
      if( empty($fields) || $fields[0] == "*" ) {
        $fields = "*";
      } else {
        $fields = implode(', ', $fields);
      }
      
      $sql = "SELECT " . $fields
           . " FROM " . $this->table;
          
      return $this->db->query($sql);
      
    }
    
  }
  
?>