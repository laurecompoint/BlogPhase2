<?php require_once '../tools/_db.php';


if(isset($_GET['logout']) && isset($_SESSION['is_admin'])){

	//la fonction unset() détruit une variable ou une partie de tableau. ici on détruit la session user
	unset($_SESSION["is_admin"]);
	//détruire $_SESSION["user"] va permettre l'affichage du bouton connexion / inscription de la nav, et permettre à nouveau l'accès aux formulaires de connexion / inscription
}

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
		$admin = $query->fetch();

		//si un utilisateur correspond
		if($admin){

			$_SESSION['admin'] = $admin['is_admin'];

		}
		else{ //si pas d'utilisateur correspondant on génère un message pour l'afficher plus bas
			$message = "Mauvais identifiants";
		}
	}


}
?>


<!DOCTYPE html>
<html>
	<head>

		<title>Administration - Mon premier blog !</title>

		<?php require 'partials/head_assets.php'; ?>

	</head>
	<body class="index-body">
		<div class="container-fluid">
			<?php require 'partials/header.php'; ?>
			<div class="row my-3 index-content">

				<?php require 'partials/nav.php'; ?>





			<main class="col-5">

				<ul class="nav nav-tabs justify-content-center nav-fill" role="tablist">
					<li class="nav-item">
						<a class="nav-link <?php if(isset($_POST['login']) || !isset($_POST['register'])): ?>active<?php endif; ?>" data-toggle="tab" href="#login" role="tab">Connexion</a>
					</li>

				</ul>

				<div class="tab-content">
					<div class="tab-pane container-fluid <?php if(isset($_POST['login']) || !isset($_POST['register'])): ?>active<?php endif; ?>" id="login" role="tabpanel">

						<form action="index.php" method="post" class="p-4 row flex-column">

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

			</main>
	</div>

		</div>
	</body>
</html>
