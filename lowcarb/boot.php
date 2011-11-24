<?php if(!BOOT) exit("No direct script access.");
  
  /**
   * 
   * ✧ lowcarb
   *   super-light php blog
   *
   *   copyright (c) Tom Ashworth
   */
  
  $dir = $config->system['root'] . $config->system['lowcarb'] . 'components/';
  
  foreach($config->autoload as $component) {
    
    $file = $dir . $component . ".php";
    
    if( !is_file($file) ) {
      exit($component . " component does not exist.");
    } else {
      require($file);
    }
    
  }
  
?>