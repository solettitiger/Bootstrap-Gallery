<?php
// EBID 2021
// #################################################################
// # Detailseite only one image in a fullpage canvas
// #################################################################
require_once('config.php');
require_once('gallery.php');
$folder = strip_tags($_REQUEST['p']);
$file  = strip_tags($_REQUEST['f']);
$gal = new Gallery(); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<title><?php echo IMG_TITLE ?></title>
<link href="/bilder/favicon.ico" rel="shortcut icon">
<link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="./assets/fontawesome/css/all.min.css" rel="stylesheet">
<link href="https://ex.ebid.at/bilder/" rel="canonical">
<style>
* { margin:0; padding:0; }
body,html { height:100%;background-color:black; }
main { position:fixed;height:100vh;width:100vw;background-color:black;overflow:hidden;text-align:center;z-index:1; }
.pinch-zoom-parent {}
.pinch-zoom {}
.modal-menu   { position:absolute;left:0;top:0;height:150px;width:100vw;z-index:10; }
.modal-header { position:absolute;width:100vw;height:50px;z-index:11; }
#image { max-height:100%;max-width:100%; }
#log { position:fixed;right:0;bottom:0;height:50px;width:420px;background-color:white;z-index:10; }
</style>
</head>
<body>

<main class="pinch-zoom-parent">
	<div class="pinch-zoom">
		<img id="image" src="./<?php echo $file; ?>">
	</div>
</main>
<div class="modal-menu">
	<div class="modal-header">
		<button type="button" class="btn btn-outline-light float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i></button>
		<button type="button" class="btn btn-outline-light" id="close-image-window" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
		<button type="button" class="btn btn-outline-light float-right" id="show-next-image"><i class="fa fa-arrow-right"></i></button>
	</div>
</div>
<div id="log" style="display:none"></div>

<script src="./assets/jquery/jquery-3.6.0.min.js"></script>
<script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/wheelzoom.js"></script>
<script src="./assets/js/pinch-zoom.umd.js"></script>
<script type="text/javascript">
var nxtimg = "<?php echo $gal::nextImage($folder,$file); ?>";
var preimg = "<?php echo $gal::prevImage($folder,$file); ?>";
var wz;

$(document).ready(function() {
	initImage();
	$(window).resize(function() { location.reload(); });
	
	$('#show-next-image').click(function () { nextImage(); });
	$('#show-previous-image').click(function () { prevImage(); });
	$('#close-image-window').click(function () { closeWin(); });
	
	$(window).keyup(function(ev) {
		if(ev.which == 27) { closeWin(); }
		if(ev.which == 39) { nextImage(); }
		if(ev.which == 37) { prevImage(); }
		event.preventDefault();
	});
	
	function closeWin() {
		const params = new URLSearchParams(location.search);
		location.href = 'detail1.php?p='+params.get('p');
	}
	
	function nextImage() {
		const params = new URLSearchParams(location.search);
		location.href = 'detail3.php?p='+params.get('p')+'&f='+nxtimg;
	};
	
	function prevImage() {
		const params = new URLSearchParams(location.search);
		location.href = 'detail3.php?p='+params.get('p')+'&f='+preimg;
	};
	
	function initImage() {
		var touchDevice = (navigator.maxTouchPoints || 'ontouchstart' in document.documentElement);
		if(touchDevice) {
			var el = document.querySelector('div.pinch-zoom');
			new PinchZoom.default(el, {});
		} else {
			// Menu Animation
			$('.modal-menu').on('mouseenter', function() { $('.modal-header').fadeIn(200); });
			$('.modal-menu').on('mouseleave', function() { $('.modal-header').fadeOut(500); });
			wz = wheelzoom(document.querySelector('#image'));
		}
	};
});
</script>
</body>
</html>
