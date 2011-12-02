<? include("layout.php"); ?>

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

  <form action=/write method=post>
    <h2>new post</h2>
    <div role=field>
      <label for=title>on</label>
      <input name=title type=text placeholder="something interesting..." value="<?=$data['title']?>" tabindex=1>
    </div>
    <div role=field>
      <textarea name=content cols=40 rows=10 tabindex=2><?=$data['content']?></textarea>
    </div>
    <div role=button>
      <input type=submit value=publish>
    </div>
  </form>