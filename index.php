<?php
  
  /**
   * 
   * ✧ lowcarb
   *   super-light php blog
   *
   *   copyright (c) Tom Ashworth
   */
   
  /* TODO
  
  check post name isn't taken (acts like a primary key)
  document properly
  perform scan of database table on load and then check every insert and update
  
  */
  
  define('BOOT', true); // Stop direct script access
  
  error_log(date('r'));
  
  // Load components of the blog
  $components = array("config", "store", "uri", "db",
                      "router", "controller", "model",
                      "input", "auth", "session", "minidown");
  foreach($components as $file) {
    require("lowcarb/" . $file . ".php");
  }
  
  // Site Configuration
  $config = new Config();
  $config->url = "//blog.dev/";
  $config->salt = "cardiffschoolofcomputerscience";
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
  , "edit" => "edit"
  , "logout" => "out"
  , "error" => "error"
  , "comment" => "comment"
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
  
  // Articles
  $model->articles = new Model('articles', $db);
  
  // Articles
  $model->comments = new Model('comments', $db);
  
  // Input ($_POST) - stored as a model
  $model->post = new Input($_POST);
  
  // Authentication
  define('PERMISSION_NONE', 0);
  define('PERMISSION_USER', 2);
  define('PERMISSION_ELEVATED', 5);
  $model->auth = new Auth($config->salt, 'users', $db);
  
  // Minidown
  $model->md = new Minidown();
  
  // Controller
  $controller = new Controller($model, $config->url, $uri);
  
  // And away we goes...
  if( method_exists($controller, $route['function']) ) {
    
    // Debuggin'
    $buf = "Req: " . $route['function'];
    if( $model->post->sent() ) {
      $buf .= "\nPOST:";
      $buf .= print_r($_POST, true);
    }
    error_log($buf);
    
    // This is nasty nasty nasty, but PHP is PHP.
    call_user_func_array(array($controller, $route['function']), $route['arguments']);
    
  } else {
    
    // http://en.wikipedia.org/wiki/Hyper_Text_Coffee_Pot_Control_Protocol
    exit("418 Error. I'm a teapot.");
    
  }
  
?>