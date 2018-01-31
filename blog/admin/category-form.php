<?php require_once '../tools/_db.php'; ?>

<?php
if(isset($_POST['save']) ){

 $query = $db->prepare('INSERT INTO category (id, name, description) VALUES (?, ?, ?)');
 $result = $query->execute(
 [
 $_POST['id'],
 $_POST['name'],
 $_POST['description']
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

<form action="category-form.php" method="POST">

  <label>id <input type="text" name="id" value="" placeholder="id" /> </label> <br>

  <label>Name <input type="text" name="name" value="" placeholder="name" /> </label> <br>

  <label>Description <input type="text" name="description" value="" placeholder="description" /> </label> <br>

    <input type="submit" name="save" value="Sauvegarder" />

</form>


  </body>
</html>
