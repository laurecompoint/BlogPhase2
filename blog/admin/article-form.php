<?php
require_once '../tools/_db.php';

if(isset($_POST['save'])){
    $query = $db->prepare('INSERT INTO article (title, category_id, summary, content, is_published) VALUES (?, ?, ?, ?, ?)');
    $newArticle = $query->execute(
		[
			$_POST['title'],
			$_POST['category_id'],
      $_POST['summary'],
      $_POST['content'],
      $_POST['is_published']

		]
    );

	if($newArticle){
		header('location:article-list.php');
		exit;
    }
	else{
		$message = "Impossible d'enregistrer le nouvel article...";
	}
}

if(isset($_POST['update'])){

	$query = $db->prepare('UPDATE article SET
		title = :tile,
    category_id = :category_id,
    summary = :summary,
    content = :content,
		is_published = :is_published,
		WHERE id = :id'
	);


	$result = $query->execute(
		[
			'title' => $_POST['title'],
      'category_id' => $_POST['category_id'],
      'summary' => $_POST['summary'],
      'content' => $_POST['content'],
			'is_published' => $_POST['is_published'],
			'id' => $_POST['id'],
		]
	);

	if($result){
		header('location:article-list.php');
		exit;
	}
	else{
		$message = 'Erreur.';
	}
}


if(isset($_GET['category_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){

	$query = $db->prepare('SELECT * FROM article WHERE id = ?');
    $query->execute(array($_GET['article_id']));

	$article = $query->fetch();
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

						<h4><?php if(isset($article)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> un article</h4>
					</header>

					<?php if(isset($message)):  ?>
					<div class="bg-danger text-white">
						<?php echo $message; ?>
					</div>
					<?php endif; ?>



					<form action="article-form.php" method="post">
						<div class="form-group">
							<label for="title">Title : </label>
							<input class="form-control" <?php if(isset($article)): ?>value="<?php echo $user['title']?>"<?php endif; ?> type="text" placeholder="title" name="title" id="title" />
						</div>
            <div class="form-group">
              <label for="category_id">category</label>
							<select class="form-control" name="category_id" id="category_id">
								<option value="0" <?php while(isset($article) && $article['category_id'] == 1): ?>selected<?php endwhile; ?>>Cinéma</option>
								<option value="1" <?php while(isset($article) && $article['category_id'] == 2): ?>selected<?php endwhile; ?>>Musique</option>
                <option value="2" <?php while(isset($article) && $article['category_id'] == 3): ?>selected<?php endwhile; ?>>Théatre</option>
								<option value="3" <?php while(isset($article) && $article['category_id'] == 4): ?>selected<?php endwhile; ?>>Jeux video</option>
							</select>
						</div>
            <div class="form-group">
							<label for="title">summary : </label>
							<input class="form-control" <?php if(isset($article)): ?>value="<?php echo $user['summary']?>"<?php endif; ?> type="text" placeholder="summary" name="summary" id="summary" />
						</div>
            <div class="form-group">
							<label for="title">content : </label>
							<input class="form-control" <?php if(isset($article)): ?>value="<?php echo $user['content']?>"<?php endif; ?> type="text" placeholder="content" name="content" id="content" />
						</div>
						<div class="form-group">
              <label for="is_published">Is_published</label>
							<select class="form-control" name="is_published" id="is_published">
								<option value="0" <?php if(isset($article) && $article['is_published'] == 0): ?>selected<?php endif; ?>>Non</option>
								<option value="1" <?php if(isset($article) && $article['is_published'] == 1): ?>selected<?php endif; ?>>Oui</option>
							</select>
						</div>

						<div class="text-right">

							<?php if(isset($article)): ?>
							<input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />

							<?php else: ?>
							<input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
							<?php endif; ?>
						</div>


						<?php if(isset($article)): ?>
						<input type="hidden" name="id" value="<?php echo $article['id']?>" />
						<?php endif; ?>

					</form>
				</section>
			</div>

		</div>
	</body>
</html>
