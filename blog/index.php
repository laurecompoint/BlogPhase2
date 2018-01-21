<?php require_once '_db.php'; ?>

<!DOCTYPE html>
<html>
	<head>

		<title>Homepage - Mon premier blog !</title>

		<?php require 'partials/head_assets.php'; ?>

	</head>
	<body class="index-body">
		<div class="container-fluid">

			<?php require 'partials/header.php'; ?>

			<div class="row my-3 index-content">

				<?php require 'partials/nav.php'; ?>

				<main class="col-9">
					<section class="latest_articles">
						<header class="mb-4"><h1>Les 3 derniers articles :</h1></header>

<?php $query = $db->query('SELECT * FROM article LIMIT  5, 4') ; ?>
<?php $data = $query->fetch();?>

<?php while( $data = $query->fetch () ) : ?>

<ul>
         <h2>
              <?php echo $data ['title'];?>
         </h2>

         <div class="article-date">
              <?php echo $data ['created_at'];?>
          </div>

          <div class="article-content">
              <?php echo $data ['summary'];?>
          </div>

          <a href="article.php?id=
             <?php echo $data['id'] ?>"> > Lire l’article
          </a>
 </ul>
 
<?php endwhile; ?>

<?php $query->closeCursor();?>


 			</section>
					<div class="text-right">
						<a href="article_list.php">> Tous les articles</a>
					</div>
				</main>
			</div>

			<?php require 'partials/footer.php'; ?>

		</div>
	</body>
</html>
