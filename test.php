<?php

  /*print("HELLO => " . mysql_escape_string("HELLO"));

  if($_POST['text']) {
    
    $content = $_POST['text'];
    $output = $content . "\n\n";
    
    //$tab = "&nbsp;&nbsp;&nbsp;&nbsp;";
    
    // Standardise newlines
    $output = preg_replace("/\r\n/i", "\n", $output);
    $output = preg_replace("/\r/i", "\n", $output);
    
    //$output = preg_replace("/\s{4}/i", $tab, $output);
    
    $markdown = array(
      "/#+\s{1}(.+)\n+/i" => "<h3>$1</h3>"
    , "/(-\s{1}(.+)\n{1}.+)/im" => "<ul>$1"
    , "/(-\s{1}(.+)\n)\n+/im" => "$1</ul>"
    , "/(-\s{1}(.+))\n?/i" => "<li>$2</li>"
    , "/\((.+)\)\[(.+)\]/i" => "<a href=$2>$1</a>"
    , "/(>\s{1}(.+))\n?/i" => "<p>$2</p>"
    );
                     
    foreach($markdown as $pattern => $replace) {
      
      $output = preg_replace($pattern, $replace, $output);
            
    }
    
    print($output);
    
  }*/
  
  print_r($_SERVER);
  
?>
<hr />
<form action method=post>
  <textarea name=text rows=10 cols=40><?=$_POST['text']?></textarea>
  <input type=submit>
</form>