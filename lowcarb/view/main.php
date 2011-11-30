<? include("layout.php"); ?>

  <? $articles = $data['articles']; ?>
  
  <? // Dare to enter the loop? ?>
  <? foreach($articles as $article): ?>
      
    <article>
      <h2><a href=<?=$this->url?>on/<?=$article['name']?>><?=$article['title']?></a></h2>
      <?=$article['content']?>
    </article>
  
  <? endforeach; ?>