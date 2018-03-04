<?php

require_once 'tools/common.php';

if(isset($_GET['article_id'] ) ){

	//selection de l'article dont l'ID est envoyé en paramètre GET
	$query = $db->prepare('
		SELECT article.* , category.name AS category_name
		FROM article
		JOIN category
		ON article.category_id = category.id
		WHERE article.id = ? AND article.is_published = 1');
	$query->execute( array( $_GET['article_id'] ) );

	$article = $query->fetch();

	//si pas d'article trouvé dans la base de données, renvoyer l'utilisateur vers la page index
	if(!$article){
		header('location:index.php');
		exit;
	}

}
else{ //si article_id n'est pas envoyé en URL, renvoyer l'utilisateur vers la page index
	header('location:index.php');
	exit;
}

?>

<!DOCTYPE html>
<html>
 <head>

	<title><?php echo $article['title']; ?> - Mon premier blog !</title>

   <?php require 'partials/head_assets.php'; ?>

 </head>
 <body class="article-body">
	<div class="container-fluid">

		<?php require 'partials/header.php'; ?>

		<div class="row my-3 article-content">

			<?php require 'partials/nav.php'; ?>

			<main class="col-9">
				<article>
					<?php if(!empty($article['image'])): ?>
					<div class="col-12 col-md-4 col-lg-3">
						<img class="img-fluid" src="img/article/<?php echo $article['image']; ?>" alt="<?php echo $article['title']; ?>" />
					</div>
					<?php endif; ?>

					<h1 class="h3"><?php echo $article['title']; ?></h1>
					<b class="article-category">[<?php echo $article['category_name']; ?>]</b>
					<span class="article-date">Créé le <?php echo $article['created_at']; ?></span>
					<div class="article-content">
						<?php echo $article['content']; ?>
					</div>
				</article>
			</main>

		</div>

		<?php require 'partials/footer.php'; ?>

	</div>
 </body>
</html>
