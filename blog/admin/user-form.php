<?php require_once '../tools/_db.php'; ?>

<?php
   if(isset($_POST['save']) ){

    $query = $db->prepare('INSERT INTO user (firstname, lastname, email, password, is_admin, bio) VALUES (?, ?, ?, ?, ?, ?)');
    $result = $query->execute(
    [
    $_POST['firstname'],
    $_POST['lastname'],
    $_POST['email'],
    $_POST['password'],
    $_POST['is_admin'],
    $_POST['bio']
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


<form action="user-form.php" method="POST">

      <label>FIRST NAME
        <input type="text" name="firstname" value="" placeholder="First name" />
      </label><br>
      <label>LAST NAME <input type="text" name="lastname" value="" placeholder="Last name" /> <br> </label>
      <label>EMAIL <input type="email" name="email" value="" placeholder="Email" /> <br> </label>
      <label>PASSWORD <input type="password" name="password" value="" placeholder="Password" /> <br> </label>

  <textarea name="bio" rows="6" cols="10" placeholder="Ta vie ton oeuvre">

  </textarea>


      <label>ADMIN </label>
      <select name="is_admin">
        <option value="1">Oui</option>
        <option value="0">non</option>
      </select>

      <br>

        <input type="submit" name="save" value="Sauvegarder" />



</form>


  </body>
</html>
