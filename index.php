<?php
  
  /**
   * 
   * ✧ lowcarb
   *   super-light php blog
   *
   *   copyright (c) Tom Ashworth
   */
  
  define('BOOT', true); // Stop direct script access
  
  $components = array("config", "uri", "db", "router");
  
  foreach($components as $file) {
    require("lowcarb/" . $file . ".php");
  }
  
  $config = new Config();
  
  $config->db = array(
    "host" => "localhost"
  , "user" => "root"
  , "password" => "root"
  , "db" => "lowcarb"
  );
  
  $config->routes = array(
    "" => "index"
  , "edit" => "edit"
  );
  
  $db = new DB($config->db);
  $uri = new URI();
  
  $router = new Router($config->routes);
  
  echo "<br/>Function: " . $router->match($uri->segments());
  
?>