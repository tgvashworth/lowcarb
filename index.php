<?php
  
  /**
   * 
   * ✧ lowcarb
   *   super-light php blog
   *
   *   copyright (c) Tom Ashworth
   */
  
  // Set environment ('' defaults to development)
  $environment = '';
  
  // Pick components to autoload
  $autoload = array("uri", "db");
  
  // Don't touch these
  $system_dir = "lowcarb";
  $application_dir = "app";
  
  // Check that these folders are correct
  $system_dir = trim(trim($system_dir), '/');
  $applciation_dir = trim(trim($application_dir), '/');
  
  if( !is_dir($system_dir) ) {
    exit("System folder not configured correctly.");
  }
  
  if( !is_dir($application_dir) ) {
    exit("Application folder not configured correctly.");
  }
  
  $system_dir .= '/';
  $application_dir .= '/';
  
  require($system_dir . "config.php");
  
  // Create new configuration object  
  $config = new Config($environment);
  
  // Store the key directories
  $config->system = array(
    "lowcarb" => $system_dir
  , "application" => $application_dir
  );
  
  // Set components to be autoloaded by the application
  $config->autoload = $autoload;
  
  require($system_dir . "lowcarb.php");
  
  // Create lowcarb object
  $lc = new Lowcarb();
  
?>