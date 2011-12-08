<?php if(!BOOT) exit("No direct script access.");

  /**
   * 
   * ✧ lowcarb
   *   super-light php blog framework
   * 
   *   Minidown (super-light markdown parser)
   * 
   *   autoloaded
   * 
   */
  class Minidown {
    
    /**
     * parse "markdown" to html
     *
     * @param string $string 
     * @return string
     * @author Tom Ashworth
     */
    public function out($string) {
      
      $string = stripslashes($string);
      
      $string .= "\n\n";

      // Standardise newlines
      $string = preg_replace("/\r\n/i", "\n", $string);
      $string = preg_replace("/\r/i", "\n", $string);
      $string = preg_replace("/>/i", "&gt;", $string);
      $string = preg_replace("/\n{4,}/i", "\n\n\n", $string);

      // The RegEx beauty
      $markdown = array(
        "/\n+(&gt;\s{1}(.+))\n{2,}/i" => "<blockquote>$2</blockquote>\n"
      , "/#+\s{1}(.+)\n+/i" => "<h3>$1</h3>\n"
      , "/\((.+?)\)\[(\S+?)\]/i" => "<a href=$2>$1</a>"
      , "/\n{2,}(-\s{1}(.+)\n{1}.+)/im" => "\n<ul>$1"
      , "/(-\s{1}(.+)\n)\n+/im" => "$1</ul>\n"
      , "/\n?(-\s{1}(.+))\n?/i" => "<li>$2</li>"
      , "/^(.+)\n+/i" => "<p>$1</p end>\n"
      , "/\n+(.+)[\n+\Z]?/im" => "<p>$1</p mid>\n"
      );
    
      // Do the replacement
      foreach($markdown as $pattern => $replace) {
        $string = preg_replace($pattern, $replace, $string);
      }
      
      return $string;
      
    }
    
    
  }
  
?>