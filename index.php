<?php
// EBID 2021
// #################################################################
// # Übersichtsseite
// #################################################################
require_once('config.php');
require_once('gallery.php');
$gal = new Gallery();
$dirs = $gal::getDirectories(IMG_DIR); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo IMG_TITLE ?></title>
<link href="/bilder/favicon.ico" rel="shortcut icon">
<link href="https://ex.ebid.at/bilder/" rel="canonical">
<link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="./assets/fontawesome/css/all.min.css" rel="stylesheet">
<link href="./assets/css/styles.css" rel="stylesheet">
</head>
<body>

<?php include('header.php'); ?>

<main>
	<div class="album bg-dark">
		<div class="container-fluid">
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">

<?php foreach($dirs as $dir) { ?>
				<div class="col">
					<div class="card">
						<div class="imgthumb" style="background-image:url(resize.php?img=/<?php echo $gal::getMainImageName($dir); ?>&w=500&resize=true)" data-path="detail1.php?p=<?php echo basename($dir); ?>">
							<div class="cover"><h2><?php echo $gal::getFolderName($dir); ?></h2></div>
						</div>
					</div>
				</div>
<?php } ?>

			</div>
		</div>
	</div>
</main>

<?php include('footer.php'); ?>

<script src="assets/jquery/jquery-3.6.0.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.imgthumb').click(function(){
		location.href=($(this).data('path'));
	});
});
</script>
</body>
</html>
