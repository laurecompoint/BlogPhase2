<?php require_once '../tools/_db.php'; ?>


<?php

if(isset($_POST['save']) ){

 $query = $db->prepare( 'INSERT INTO article (category_id, title, content, summary, is_published, created_at) VALUES (?, ?, ?, ?, ?, NOW()) ');
 $result = $query->execute(
 [
 $_POST['category_id'],
 $_POST['title'],
 $_POST['content'],
 $_POST['summary'],
 $_POST['is_published']
 ]
 );


}
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Admin category</title>
  </head>
  <body>

<form action="article-form.php" method="POST">


  <label>category_id <input type="number" name="category_id" value="" placeholder="category_id" /> </label> <br>



  <label>title <input type="text" name="title" value="" placeholder="title" /> </label> <br>

  <label>Content <input type="text" name="content" value="" placeholder="content" /> </label> <br>

  <label>Summary <input type="text" name="summary" value="" placeholder="summary" /> </label> <br>

      <label>is_published<input type="number" name="is_published" value="" placeholder="is_published" /> </label> <br>

        <label>created_at <input type="date" name="created_at" value="" placeholder="created_at" /> </label> <br>

    <input type="submit" name="save" value="Sauvegarder" />

</form>


  </body>
</html>
