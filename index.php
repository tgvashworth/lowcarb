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

?>
</pre>