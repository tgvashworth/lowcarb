<!doctype html public "musings">
<html lang=en>
<head>
  <meta charset=utf-8>

  <title>Musings and such.</title>

  <script src="http://use.typekit.com/rjb8sco.js"></script>
  <script >try{Typekit.load();}catch(e){}</script>

  <link rel=stylesheet href=<?=$this->url?>css/style.css>
  
<body>
  <header role=masthead>
    <h1><a href=/>a blog.</a></h1>
  </header>
  
  <? foreach($articles as $article): ?>
      
    <article>
      <h2><a href=<?=$config->url?>on/<?=$article['name']?>><?=$article['title']?></a></h2>
      <?=$article['content']?>
    </article>
  
  <? endforeach; ?>