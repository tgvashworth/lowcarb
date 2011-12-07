
  <? $articles = $data['articles']; ?>
  
  <? // Dare to enter the loop? ?>
  <? foreach($articles as $article): ?>
      
    <article>
      <h2><a href=<?=$this->url?>on/<?=$article['name']?>><?=$article['title']?></a></h2>
      <aside>
        <time><?=$article['date']?></time>
      </aside>
      <?=$article['content']?>
    </article>
    
  <? endforeach; ?>
  
  <? if( empty($articles) ) : ?>
    
    <article>
      <h2>Gosh darn it.</h2>
      <p>No <a href=<?=$this->url?>>articles</a> found. Sorry!</p>
    </article>
    
  <? endif;?>
  