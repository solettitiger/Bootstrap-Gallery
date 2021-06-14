<?php
// EBID 2021
// #################################################################
// # Detailseite
// #################################################################
require_once('config.php');
require_once('gallery.php');
$gal = new Gallery();
$folder = strip_tags($_REQUEST['p']);
$files = $gal::getFiles($folder); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo IMG_TITLE ?></title>
<link href="/bilder/favicon.ico" rel="shortcut icon">
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

<?php foreach($files as $file) { 
        $img = $gal::getImageFile($folder,$file); ?>
        <div class="col">
          <div class="card">
            <a href="#" class="thumbnail" data-image-id="" data-toggle="modal" data-image="<?php echo $img; ?>" data-target="#image-gallery"><div class="imgdetail" style="background-image:url(resize.php?img=/<?php echo $img; ?>&w=500&resize=true)"></div></a>
          </div>
        </div>
<?php } ?>

      </div>
      
    </div>
  </div>
</main>

<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-menu">
				<div class="modal-header">
				<button type="button" class="btn btn-outline-light float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i></button>
				<button type="button" class="btn btn-outline-light" id="load-this-image"><i class="fa fa-eye"></i></button>
				<button type="button" class="btn btn-outline-light" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
				<button type="button" class="btn btn-outline-light" id="load-this-list"><i class="fa fa-fast-forward"></i></button>
				<button type="button" class="btn btn-outline-light float-right" id="show-next-image"><i class="fa fa-arrow-right"></i></button>
				</div>
			</div>
			<div class="modal-body text-center">
				<img id="image-gallery-image" src="">
			</div>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>

<script src="./assets/jquery/jquery-3.6.0.min.js"></script>
<script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/gallery.js"></script>
</body>
</html>
