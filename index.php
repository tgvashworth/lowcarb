<!doctype html public "blog">
<pre>
<?php

  include("lowcarb/core/config.php");
  include("lowcarb/core/db.php");
  include("lowcarb/core/model.php");
  
  $config = new Config();
  
  $config->db = array(
    "host" => "localhost"
  , "user" => "root"
  , "password" => "root"
  , "db" => "lowcarb"
  );
  
  $db = new DB($config->db);
  
  $articles = new Model("articles", $db);
  
  $result = $articles->select();
    
  while($row = mysql_fetch_array($result)) {
    echo $row["title"] . "\n";
  }
  
  

?>
</pre>