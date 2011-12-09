<!doctype html public "musings">
<html lang=en>
<head>
  <meta charset=utf-8>

  <title>Musings <?=$data['title']?></title>

  <? // Typekit font embedding - checked with Dr Sidorov. Removing causes no change in functionality ?>
  <script src="https://use.typekit.com/rjb8sco.js"></script>
  <script >try{Typekit.load();}catch(e){}</script>

  <link rel=stylesheet href=<?=$this->url?>css/style.css>
  
<body>
  
  <div class=container role=content>
  
    <header role=masthead>
      <h1><a href=<?=$this->url?>>&#10026; musings</a></h1>
    </header>
    
    <?php include($view . ".php"); ?>
    
  </div>
  
  <?php if( $data['showintro'] ) include("intro.php"); ?>
  
  <?php if( $data['showcomments'] ) include("comments.php"); ?>
  
  <?php if( $data['showadmin'] ) include("admin.php"); ?>