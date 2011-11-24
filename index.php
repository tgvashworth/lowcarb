<?php
  
  /**
   * 
   * ✧ lowcarb
   *   super-light php blog
   *
   *   copyright (c) Tom Ashworth
   */
  
  define('BOOT', true);
  
  /**
   * user adjustable settings
   *
   */
   
  $environment = '';
  $autoload = array("uri", "db");
  $system_dir = "lowcarb";
  
  /**
   * lowcarb initialisation
   *
   */
  
  // check that these folders are correct
  $system_dir = trim(trim($system_dir), '/');
  
  if( !is_dir($system_dir) ) {
    exit("System folder not configured correctly.");
  }
  
  $system_dir .= '/';
  
  // load config class
  require($system_dir . "components/config.php");
  
  // create new configuration object  
  $config = new Config($environment);
  
  $config->system = array(
    "lowcarb" => $system_dir
  , "root" => $_SERVER['DOCUMENT_ROOT'] . '/'
  );
  
  // set components to be autoloaded by the application
  $config->autoload = $autoload;
  
  // load app class
  require($system_dir . "lowcarb.php");
  
  // create application object
  $lc = new Lowcarb();
  
  // and away we go
  require($system_dir . "boot.php");
  
?>