
  <? if(!empty($errors)): ?>
  <div class="error">
    <ul>
    <?php
      foreach($errors as $error) {
        ?>
          <li><?=$error?></li>
        <?
      }
    ?>
    </ul>
  </div>
  <? endif; ?>

  <section role=write>
    <form action=<?=$this->url?><?=$data['action']?> method=post>
      <h2><?=$data['mode']?> post</h2>
      <aside>Some <a href="http://daringfireball.net/projects/markdown/">Markdown</a> supported. Use short titles.</aside>
      <div role=field>
        <label for=title>on</label>
        <input name=title type=text placeholder="something interesting..." value="<?=$data['title']?>" tabindex=1>
      </div>
      <div role=field>
        <textarea name=content cols=40 rows=10 tabindex=2><?=stripslashes($data['content'])?></textarea>
      </div>
      <div role=button>
      <? if( $data['mode'] == "edit" ) : ?>
        <input type=hidden name=id value=<?=$data['id']?>>
      <? endif; ?>
        <input type=submit value=publish>
      </div>
    </form>
  </section>
  
