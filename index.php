<?php
  
  /**
   * 
   * ✧ lowcarb
   *   super-light php blog
   *
   *   copyright (c) Tom Ashworth
   */
  
  // Preload settings
  $components = array("config", "uri", "db");
  
  // Load components
  foreach($components as $file) {
    require("lowcarb/" . $file . ".php");
  }
  
  // Setup config
  $config = new Config();
  
  $config->db = array(
    "host" => "localhost"
  , "user" => "root"
  , "password" => "root"
  , "db" => "lowcarb"
  );
  
  // (Lazy) load database
  $db = new DB($config->db);
  
  // Parse the URI
  $uri = new URI();
    
?>