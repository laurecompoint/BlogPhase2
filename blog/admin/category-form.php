<?php
require_once '../tools/_db.php';

//Si $_POST['save'] existe, cela signifie que c'est un ajout d'utilisateur
if(isset($_POST['save'])){
    $query = $db->prepare('INSERT INTO category (name, description) VALUES (?, ?)');
    $newCategory = $query->execute(
		[
			$_POST['name'],
			$_POST['description']

		]
    );
	//redirection après enregistrement
	//si $newUser alors l'enregistrement a fonctionné
	if($newCategory){
		header('location:category-list.php');
		exit;
    }
	else{ //si pas $newUser => enregistrement échoué => générer un message pour l'administrateur à afficher plus bas
		$message = "Impossible d'enregistrer le nouvel utilisateur...";
	}
}

//Si $_POST['update'] existe, cela signifie que c'est une mise à jour d'utilisateur
if(isset($_POST['update'])){

	$query = $db->prepare('UPDATE category SET
		name = :name,
		description = :description,
		WHERE id = :id'
	);

	//données du formulaire
	$result = $query->execute(
		[
			'name' => $_POST['name'],
			'description' => $_POST['description'],
			'id' => $_POST['id'],
		]
	);

	if($result){
		header('location:category-list.php');
		exit;
	}
	else{
		$message = 'Erreur.';
	}
}


if(isset($_GET['category_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){

	$query = $db->prepare('SELECT * FROM category WHERE id = ?');
    $query->execute(array($_GET['category_id']));

	$user = $query->fetch();
}

?>
<!DOCTYPE html>
<html>
	<head>

		<title>Administration des utilisateurs - Mon premier blog !</title>

		<?php require 'partials/head_assets.php'; ?>

	</head>
	<body class="index-body">
		<div class="container-fluid">

			<?php require 'partials/header.php'; ?>

			<div class="row my-3 index-content">

				<?php require 'partials/nav.php'; ?>

				<section class="col-9">
					<header class="pb-3">

						<h4><?php if(isset($category)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une category</h4>
					</header>

					<?php if(isset($message)): ?>
					<div class="bg-danger text-white">
						<?php echo $message; ?>
					</div>
					<?php endif; ?>



					<form action="category-form.php" method="post">
						<div class="form-group">
							<label for="firstname">Name Category :</label>
							<input class="form-control" <?php if(isset($category)): ?>value="<?php echo $user['name']?>"<?php endif; ?> type="text" placeholder="Name" name="name" id="name" />
						</div>
						<div class="form-group">
							<label for="lastname">Description : </label>
							<input class="form-control" <?php if(isset($category)): ?>value="<?php echo $user['description']?>"<?php endif; ?> type="text" placeholder="Description" name="description" id="description" />
						</div>

						<div class="text-right">

							<?php if(isset($category)): ?>
							<input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />

							<?php else: ?>
							<input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
							<?php endif; ?>
						</div>


						<?php if(isset($category)): ?>
						<input type="hidden" name="id" value="<?php echo $category['id']?>" />
						<?php endif; ?>

					</form>
				</section>
			</div>

		</div>
	</body>
</html>
