  
  <div class=container role=admin>

    <header>
      <h2>&#10026;</h2>
    </header>
  
    <nav>
      <h2><a href=/write>New post</a></h2>
      <h2>Edit:</h2>
      <? //$articles = $data['articles']; ?>
      <ul>
      <? // Dare to enter the loop? ?>
      <? foreach($articles as $article): ?>
        <li><a href=<?=$this->url?>edit/<?=$article['name']?>><?=$article['title']?></a></li>
      <? endforeach; ?>
      <ul>
    </nav>
  
  </div>