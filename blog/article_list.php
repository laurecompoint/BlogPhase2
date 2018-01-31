<?php require_once './tools/_db.php'; ?>


<!DOCTYPE html>
<html>
 <head>

	<title>

		</title>

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


					</header>

					<article>


					<?php $query = $db->prepare('SELECT * FROM article WHERE category_id = ?'); ?>
					<?php $query->execute( array( $_GET['category_id'] ) ); ?>


					<?php while ( $data = $query->fetch()) : ?>


							<h2><?php echo $data['title'];?></h2>
							<div class="data"><?php echo $data['created_at'];?></div>
							<div class="content"><?php echo $data ['content']; ?></div>


					<?php endwhile; ?>
          </article>

				</section>
			</main>

		</div>

		<?php require 'partials/footer.php'; ?>

	</div>
 </body>
</html>
