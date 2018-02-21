<?php

require_once 'tools/_db.php';

//en cas de connexion
if(isset($_POST['login'])){

	//si email ou password non renseigné
	if(empty($_POST['email']) OR empty($_POST['password'])){
		$message = "Merci de remplir tous les champs";
	}
	else{
		//on cherche un utilisateur correspondant au couple email / password renseigné
		$query = $db->prepare('SELECT *
							FROM user
							WHERE email = ? AND password = ?');
		$query->execute( array( $_POST['email'], $_POST['password'] ) );
		$user = $query->fetch();

		//si un utilisateur correspond
		if($user){

			$_SESSION['user'] = $user['firstname'];

		}
		else{ //si pas d'utilisateur correspondant on génère un message pour l'afficher plus bas
			$message = "Mauvais identifiants";
		}
	}
}

//TODO en cas d'enregistrement
if(isset($_POST['register'])){
	if(empty($_POST['email']) OR empty($_POST['password']) OR empty($_POST['firstname'])){
	 $message = "Merci de remplir tous les champs";
 }

	 else{

		 $query = $db->prepare('INSERT INTO user (firstname, lastname, password, email, bio) VALUES (?, ?, ?, ?, ?)');
		 $newUser = $query->execute(
		 [
			 $_POST['firstname'],
			 $_POST['lastname'],
			 $_POST['password'],
			 $_POST['email'],
			 $_POST['bio']
		 ]
		 );

 }

}

//si l'utilisateur a déjà une session (il est déjà connécté), on le redirige ailleurs
if(isset($_SESSION['user'])){
	header('location:index.php');
	exit;
}

?>

<!DOCTYPE html>
<html>
 <head>

	<title>Login - Mon premier blog !</title>

   <?php require 'partials/head_assets.php'; ?>

 </head>
 <body class="article-body">
	<div class="container-fluid">

		<?php require 'partials/header.php'; ?>

		<div class="row my-3 article-content">

			<?php require 'partials/nav.php'; ?>

			<main class="col-9">

				<ul class="nav nav-tabs justify-content-center nav-fill" role="tablist">
					<li class="nav-item">
						<a class="nav-link <?php if(isset($_POST['login']) || !isset($_POST['register'])): ?>active<?php endif; ?>" data-toggle="tab" href="#login" role="tab">Connexion</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php if(isset($_POST['register'])): ?>active<?php endif; ?>" data-toggle="tab" href="#register" role="tab">Inscription</a>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane container-fluid <?php if(isset($_POST['login']) || !isset($_POST['register'])): ?>active<?php endif; ?>" id="login" role="tabpanel">

						<form action="login-register.php" method="post" class="p-4 row flex-column">

							<h4 class="pb-4 col-sm-8 offset-sm-2">Connexion</h4>

							<?php if(isset($message)): ?>
							<div class="text-danger col-sm-8 offset-sm-2 mb-4"><?php echo $message; ?></div>
							<?php endif; ?>

							<div class="form-group col-sm-8 offset-sm-2">
								<label for="email">Email</label>
								<input class="form-control" value="" type="email" placeholder="Email" name="email" id="email" />
							</div>

							<div class="form-group col-sm-8 offset-sm-2">
								<label for="password">Mot de passe</label>
								<input class="form-control" value="" type="password" placeholder="Mot de passe" name="password" id="password" />
							</div>

							<div class="text-right col-sm-8 offset-sm-2">
								<input class="btn btn-success" type="submit" name="login" value="Valider" />
							</div>

						</form>

					</div>
					<div class="tab-pane container-fluid <?php if(isset($_POST['register'])): ?>active<?php endif; ?>" id="register" role="tabpanel">

						<form action="login-register.php" method="post" class="p-4 row flex-column">

							<h4 class="pb-4 col-sm-8 offset-sm-2">Inscription</h4>

							<?php if(isset($message)): ?>
							<div class="text-danger col-sm-8 offset-sm-2 mb-4"><?php echo $message; ?></div>
							<?php endif; ?>

							<div class="form-group col-sm-8 offset-sm-2">
								<label for="firstname">Prénom <b class="text-danger">*</b></label>
								<input class="form-control" value="" type="text" placeholder="Prénom" name="firstname" id="firstname" />
							</div>
							<div class="form-group col-sm-8 offset-sm-2">
								<label for="lastname">Nom de famille</label>
								<input class="form-control" value="" type="text" placeholder="Nom de famille" name="lastname" id="lastname" />
							</div>
							<div class="form-group col-sm-8 offset-sm-2">
								<label for="email">Email <b class="text-danger">*</b></label>
								<input class="form-control" value="" type="email" placeholder="Email" name="email" id="email" />
							</div>
							<div class="form-group col-sm-8 offset-sm-2">
								<label for="password">Mot de passe <b class="text-danger">*</b></label>
								<input class="form-control" value="" type="password" placeholder="Mot de passe" name="password" id="password" />
							</div>
							<div class="form-group col-sm-8 offset-sm-2">
								<label for="password_confirm">Confirmation du mot de passe <b class="text-danger">*</b></label>
								<input class="form-control" value="" type="password" placeholder="Confirmation du mot de passe" name="password_confirm" id="password_confirm" />
							</div>
							<div class="form-group col-sm-8 offset-sm-2">
								<label for="bio">Biographie</label>
								<textarea class="form-control" name="bio" id="bio" placeholder="Ta vie Ton oeuvre..."></textarea>
							</div>

							<div class="text-right col-sm-8 offset-sm-2">
								<p class="text-danger">* champs requis</p>
								<input class="btn btn-success" type="submit" name="register" value="Valider" />
							</div>

						</form>

					</div>
				</div>
			</main>

		</div>

		<?php require 'partials/footer.php'; ?>

	</div>
 </body>
</html>
