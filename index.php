<?php
  
  /**
   * 
   * ✧ lowcarb
   *   super-light php blog
   *
   *   copyright (c) Tom Ashworth
   */
  
  define('BOOT', true); // Stop direct script access
  
  $components = array("config", "uri", "db", "router", "controller");
  
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
  , "error" => "error"
  );
  
  $db = new DB($config->db);
  
  $uri = new URI();
  
  $router = new Router($config->routes);
  
  $route = $router->match($uri->segments());
  
  $controller = new Controller();
  
  if( method_exists($controller, $route['function']) ) {
    
    // This is nasty nasty nasty, but PHP is PHP.
    call_user_func_array(array($controller, $route['function']), $route['arguments']);
    
  } else {
    
    // http://en.wikipedia.org/wiki/Hyper_Text_Coffee_Pot_Control_Protocol
    exit("418 Error. I'm a teapot.");
    
  }
  
?>