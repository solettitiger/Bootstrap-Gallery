<?php
// EBID 2021
// #################################################################
// # Detailseite horizontal scrolling
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
<style>
body { padding:0; margin:0; }
main { position:relative; height:100vh; width:100vw;
	-webkit-overflow-scrolling:touch; }
.wrapper { display:flex; flex-direction:row; 
	align-items:flex-start; flex-wrap:nowrap;
	width: auto; height:100vh;overflow:auto-x; }
.wrapper > div { pointer-events:none; flex:0 0 auto;
	height:100vh; margin:0;
	display:flex; justify-content:center; align-items:center; }
img { border-left:solid 1px #fff;height:100%;max-width:100%; }
.menu { position:fixed;width:100%;height:47px;z-index:100;padding:3px;border-bottom:1px solid #fff;opacity:0;transition: opacity 0.5s; }
.menu:hover { opacity:1; }
.menu #close-this-list { margin-left:50%;margin-right:50%; }
</style>
</head>
<body>

<main style="overflow:scroll hidden;" id="scroll">
	<div class="menu">
		<button type="button" class="btn btn-outline-light" id="close-this-list"><i class="fa fa-times"></i></button>
	</div>
	<div class="wrapper">
<?php foreach($files as $file) { 
		$img = $gal::getImageFile($folder,$file); ?>
		<div class="col"><img src="<?php echo $img; ?>" loading="lazy"></div>
<?php } ?>
	</div>
</main>

<script src="./assets/jquery/jquery-3.6.0.min.js"></script>
<script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
var item = document.getElementById("scroll");
window.addEventListener("wheel", function (e) {
	if (e.deltaY > 0) item.scrollLeft += 100;
	else item.scrollLeft -= 100;
});
$('#close-this-list').on('click', function() {
	url = 'detail1.php'+location.search;
	location.href=url;
});
$(document).keydown(function (e) {
	if(e.which == 27) { $('#close-this-list').click(); }
});
</script>
</body>
</html>
