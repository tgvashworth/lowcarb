
  <? // could the below  be improved using extract? ?>
  <? $comments = $data['comments']; $commentdata = $data['commentdata']; $commenterrors = $data['commenterrors']; ?>

  <div class=container role=comments>

    <header>
      <h2>&#10026;</h2>
    </header>

    <section>
      <h3>Comments</h3>
      <aside>
        <?=(count($comments) > 0 ? count($comments) . " so far:" : "None - be the first!")?>
      </aside>
      <section class=allcomments>
      <? // Dare to enter the loop? ?>
      <? foreach($comments as $comment): ?>
        <article role=comment>
          <h4 role=commenter><?=$comment['name']?></h4>
          <div class=commentbody>
            <?=$comment['content']?>
          </div>
        </article>
      <? endforeach; ?>
      </section>
    </section>
    
    <section id=comment role=newcomment>
      <h3><a href=#comment>New comment</a></h3>
      <div class="toggle">
        <aside>
          Be constructive and use proper English.
        </aside>
        <? if(!empty($commenterrors)): ?>
        <div class="error">
          <ul>
          <?php
            foreach($commenterrors as $error) {
              ?>
                <li><?=$error?></li>
              <?
            }
          ?>
          </ul>
        </div>
        <? endif; ?>
      
        <form action=/comment/<?=$articles[0]['name']?> method=post role=comment>
          <div role=field>
            <input name=name type=text placeholder="Your name" tabindex=1 value="<?=$commentdata['name']?>">
          </div>
          <div role=field>
            <textarea name=content cols=40 rows=4 tabindex=2 placeholder="Your comment"><?=$commentdata['content']?></textarea>
          </div>
          <? if(false) :?>
          <div role=field>
            <aside>We need to check you aren't a robot:<br/><strong>Is France a country?</strong></aside>
            <input name=robot type=text placeholder="Yes or No" tabindex=3>
            <input name=a type=hidden value=1>
          </div>
          <? endif; ?>
          <div role=button>
            <input type=hidden name=fk_article value=<?=$articles[0]['id']?> >
            <input type=submit value=comment>
          </div>
        </form>
      </div>
    </section>

  </div>