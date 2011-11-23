<pre>
<?php

  include("lowcarb/core/uri.php");

  print_r($_SERVER['REQUEST_URI']);
  echo "\n";
  
  $uri = new URI();
  
  print_r($uri->segments());

?>
</pre>