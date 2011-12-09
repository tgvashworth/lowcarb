  
   <? $editarticles = $data['editarticles']; ?>
  
  <div class=container role=admin>

    <header>
      <h1>&#10026;</h1>
    </header>
  
    <nav>
      <h2><a href=<?=$this->url?>write>New post</a></h2>
      <aside>
        <?=count($editarticles)?> posts
      </aside>
      <h3>Edit &amp; Delete</h3>
      <ul>
      <? // Dare to enter the loop? ?>
      <? foreach($editarticles as $article): ?>
        <li>
          <a href=<?=$this->url?>edit/<?=$article['name']?>><?=$article['title']?></a>
          <a class=delete href=<?=$this->url?>delete/<?=$article['name']?>>x</a>
        </li>
      <? endforeach; ?>
      </ul>
      <h3>User</h3>
      <ul>
        <li><a href=<?=$this->url?>logout>Logout</a></li>
      </ul>
    </nav>
  
  </div>
  
  <script>
  
    // Use JS to confirm deletion even
    document.addEventListener('click', function (e) {
      /* JavaScript has function scope, so variables
         are accessible in their child functions
      */
      var elem = e.target
      if( elem.className == "delete" ) {
        // Store current text (for time-based revertion)
        var original = elem.textContent 
        // Swap class and text to indicate to user that
        // a second step is required
        elem.className = "confirm"
        elem.textContent = "Delete?"
        // Reset the text & class after 4 seconds
        setTimeout(function(){
          elem.className = "delete"
          elem.textContent = original
        }, 4000)
        // Don't allow click to navigate away from page
        e.preventDefault()
        e.stopPropagation()
        return false
      }
    })
  
  </script>