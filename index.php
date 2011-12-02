<?php
  
  /**
   * 
   * ✧ lowcarb
   *   super-light php blog
   *
   *   copyright (c) Tom Ashworth
   */
  
  define('BOOT', true); // Stop direct script access
  
  // Load components of the blog
  $components = array("config", "store", "uri", "db", "router", "controller", "model", "input");
  foreach($components as $file) {
    require("lowcarb/" . $file . ".php");
  }
  
  // Site Configuration
  $config = new Config();
  $config->url = "//blog.dev/";
  $config->db = array(
    "host" => "localhost"
  , "user" => "root"
  , "password" => "root"
  , "db" => "lowcarb"
  );
  $config->routes = array(
    "" => "index"
  , "on" => "on"
  , "write" => "write"
  , "error" => "error"
  );
  
  // Database
  $db = new DB($config->db);
  
  // URI
  $uri = new URI();

  // Routing
  $router = new Router($config->routes);
  $route = $router->match($uri->segments());
  
  // Models
  $model = new Store();
  $model->articles = new Model('articles', $db);
  
  // Input ($_POST) - stored as a model
  $model->post = new Input($_POST);
  
  // Controller
  $controller = new Controller($model, $config->url);
  
  // And away we goes...
  if( method_exists($controller, $route['function']) ) {
    
    // This is nasty nasty nasty, but PHP is PHP.
    call_user_func_array(array($controller, $route['function']), $route['arguments']);
    
  } else {
    
    // http://en.wikipedia.org/wiki/Hyper_Text_Coffee_Pot_Control_Protocol
    exit("418 Error. I'm a teapot.");
    
  }
  
?>