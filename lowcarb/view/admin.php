  
   <? $editarticles = $data['editarticles']; ?>
  
  <div class=container role=admin>

    <header>
      <h2>&#10026;</h2>
    </header>
  
    <nav>
      <h2><a href=/write>New post</a></h2>
      <aside>
        <?=count($editarticles)?> posts
      </aside>
      <h3>Edit:</h3>
      <ul>
      <? // Dare to enter the loop? ?>
      <? foreach($editarticles as $article): ?>
        <li><a href=<?=$this->url?>edit/<?=$article['name']?>><?=$article['title']?></a></li>
      <? endforeach; ?>
      <ul>
      <h3>User:</h3>
      <ul>
        <li><a href=/logout>Logout</a></li>
      </ul>
    </nav>
  
  </div>