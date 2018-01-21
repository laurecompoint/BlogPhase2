<?php require_once '_db.php'; ?>

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
            <!-- contenu de l'article -->

<?php $query = $db->prepare('SELECT * FROM article WHERE id = ?'); ?>
<?php $query->execute( array( $_GET['id'] ) ); ?>



<?php while ( $data = $query->fetch()) : ?>
  <ul>
    <h2><?php echo $data['title'];?></h2>
    <div class="data"><?php echo $data['created_at'];?></div>
    <div class="content"><?php echo $data ['content']; ?></div>
 <ul>

<?php endwhile; ?>
				</article>
			</main>

		</div>

		<?php require 'partials/footer.php'; ?>

	</div>
 </body>
</html>
