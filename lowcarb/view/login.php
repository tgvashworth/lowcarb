
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
    <h2>log in</h2>
    <div role=field>
      <label for=name></label>
      <input name=name type=text placeholder="name" value="<?=$data['name']?>" tabindex=1>
    </div>
    <div role=field>
      <label for=password></label>
      <input name=password type=password placeholder="password" value="" tabindex=2>
    </div>
    <div role=button>
      <input type=submit value="log in">
    </div>
  </form>
