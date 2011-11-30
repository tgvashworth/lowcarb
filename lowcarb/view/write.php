<? include("layout.php"); ?>

  <form action=/write method=post>
    <h2>new post</h2>
    <div role=field>
      <label for=title>on</label>
      <input name=title type=text placeholder="something interesting..." tabindex=1/>
    </div>
    <div role=field>
      <textarea name=content cols=40 rows=10 tabindex=2></textarea>
    </div>
    <div role=button>
      <input type=submit value=publish>
    </div>
  </form>