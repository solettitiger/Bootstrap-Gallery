// EBID 2021
// ################################################################
// Image-Gallery
// ################################################################
$(document).ready(function () {
	loadGallery('a.thumbnail',$(this));
	$('#image-gallery .modal-body').height(window.innerHeight);
});

function loadGallery(elem, path) {
	var imgLink = $(elem, path);
	var current_image, selector, counter = 0;
	
	$('[data-image-id]', path).each(function () {
		counter++;
		$(this).attr('data-image-id', counter);
	});
	
	$('#show-next-image').click(function () { nextImage(); });
	$('#show-previous-image').click(function () { prevImage(); });
	
	function nextImage() {
		current_image++;
		if(current_image > counter) { current_image = counter; }
		selector = $('[data-image-id="' + current_image + '"]', path);
		updateGallery(selector);
	}
	
	function prevImage() {
		current_image--;
		if(current_image < 1) { current_image = 1; }
		selector = $('[data-image-id="' + current_image + '"]', path);
		updateGallery(selector);
	}
	
	function updateGallery(selector) {
		current_image = selector.data('image-id');
		$('#image-gallery-image').attr('src', selector.data('image'));
		$('#image-gallery').modal('show');
		disableButtons();
	}
	
	// This function disables buttons when needed
	function disableButtons() {
		$('#show-previous-image, #show-next-image').show();
		if (current_image === counter) {
			$('#show-next-image').hide();
		} else if (current_image === 1) {
			$('#show-previous-image').hide();
		}
	}
	
	imgLink.on('click', function () {
		updateGallery($(this));
		$('.modal-header').delay(3000).fadeOut(500); // first menu animation
	});

	// Menu Animation
	$('.modal-menu').on('mouseenter', function() { $('.modal-header').fadeIn(200); });
	$('.modal-menu').on('mouseleave', function() { $('.modal-header').fadeOut(500); });

	// build key actions
	$(this).keydown(function (e) {
		switch (e.which) {
			case 37: // left
				prevImage();
				break;
			case 39: // right
				nextImage();
				break;
			default:
				return; // exit this handler for other keys
		}
		e.preventDefault(); // prevent the default action (scroll / move caret)
	});

	// load imagefile to new window
	$('#load-this-list').on('click', function() {
		url = 'detail2.php'+location.search;
		location.href=url;
	});
	$('#load-this-image').on('click', function() {
		url = 'detail3.php'+location.search+"&f="+$('#image-gallery-image').attr('src');
		location.href=url;
	});
	
}
