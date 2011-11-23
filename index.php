<pre>
<?php

  include("lowcarb/core/config.php");
  
  $config = new Config();
  
  $config->db = array(
    "host" => "localhost"
  , "user" => "root"
  , "password" => "root"
  );

  print_r($config->db);
  
  $config->environment("production");
  
  $config->db = array(
    "host" => "productionserver"
  , "user" => "root"
  , "password" => "longpassword"
  );
  
  print_r($config->db);
  
  $config->environment("development");

  print_r($config->db);

?>
</pre>