<?php require_once '_db.php'; ?>
<?php
//si l'ID de catégorie n'est pas défini OU si la catégorie ayant cet ID n'existe pas
if(isset($_GET['category_id']) && !isset($categories[$_GET['category_id']]) ){
	header('location:index.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
 <head>

	<title><?php if(isset($_GET['category_id'])): ?><?php echo $categories[$_GET['category_id']]['name']; ?><?php else: ?>Tous les articles<?php endif; ?> - Mon premier blog !</title>

   <?php require 'partials/head_assets.php'; ?>

 </head>
 <body class="article-list-body">
	<div class="container-fluid">

		<?php require 'partials/header.php'; ?>

		<div class="row my-3 article-list-content">

			<?php require('partials/nav.php'); ?>

			<main class="col-9">
				<section class="all_aricles">
					<header>
						<?php if(isset($_GET['category_id'])): ?>
						<h1 class="mb-4"><?php echo $categories[$_GET['category_id']]['name']; ?></h1>
						<?php else: ?>
						<h1 class="mb-4">Tous les articles :</h1>
						<?php endif; ?>
					</header>

					<?php if(isset($_GET['category_id'])): ?>
					<div class="category-description mb-4">
					<?php echo $categories[$_GET['category_id']]['description']; ?>
					</div>
					<?php endif; ?>

					<?php foreach($articles as $key => $article): ?>
					<?php if( !isset($_GET['category_id']) OR ( isset($_GET['category_id']) AND $article['category_id'] == $_GET['category_id'] ) ): ?>
					<article class="mb-4">
						<h2><?php echo $article['title']; ?></h2>
						<?php if( !isset($_GET['category_id'])): ?>
						<b class="article-category">[<?php echo $categories[$article['category_id']]['name']; ?>]</b>
						<?php endif; ?>
						<span class="article-date"><?php echo $article['date']; ?></span>
						<div class="article-content">
							<?php echo $article['summary']; ?>
						</div>
						<a href="article.php?article_id=<?php echo $article['id']; ?>">> Lire l'article</a>
					</article>
					<?php endif; ?>
					<?php endforeach; ?>
				</section>
			</main>

		</div>

		<?php require 'partials/footer.php'; ?>

	</div>
 </body>
</html>
