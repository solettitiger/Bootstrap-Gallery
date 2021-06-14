/*!
	Wheelzoom 4.0.1a
	license: MIT
	http://www.jacklmoore.com/wheelzoom
	modified by EBID 2021-06-09
*/
window.wheelzoom = (function(){
	var defaults = {
		zoom: 0.10,
		maxZoom: false,
		initialZoom: false,
		initialX: 0.5,
		initialY: 0.5,
	};

	// MAIN
	var main = function(img, options){
		if (!img || !img.nodeName || img.nodeName !== 'IMG') { return; }

		var settings = {};
		var width;
		var height;
		var bgWidth;
		var bgHeight;
		var bgPosX;
		var bgPosY;
		var ctWidth;
		var ctHeight;
		var previousEvent;
		var transparentSpaceFiller;

		function setSrcToBackground(img) {
			img.style.backgroundRepeat = 'no-repeat';
			img.style.backgroundImage = 'url("'+img.src+'")';
			transparentSpaceFiller = 'data:image/svg+xml;base64,'+window.btoa('<svg xmlns="http://www.w3.org/2000/svg" width="'+ctWidth+'" height="'+ctHeight+'"></svg>');
			img.src = transparentSpaceFiller;
		}

		function updateBgStyle() {
			if (bgWidth > ctWidth) {
				if (bgPosX < (ctWidth-bgWidth)) {
					bgPosX = ctWidth-bgWidth;
				} else if (bgPosX > 0) {
					bgPosX = 0;
				}
			} else {
				bgPosX = (ctWidth-bgWidth)/2;
			}

			if (bgHeight > ctHeight) {
				if (bgPosY < (ctHeight-bgHeight)) {
					bgPosY = ctHeight-bgHeight;
				} else if (bgPosY > 0) {
					bgPosY = 0;
				}
			} else {
				bgPosY = (ctHeight-bgHeight)/2;
			}

			img.style.backgroundSize = bgWidth+'px '+bgHeight+'px';
			img.style.backgroundPosition = bgPosX+'px '+bgPosY+'px';
		}

		function reset() {
			bgWidth = width;
			bgHeight = height;
			bgPosX = (ctWidth-width)/2
			bgPosY = (ctHeight-height)/2;
			updateBgStyle();
		}

		function onwheel(e) {
			var deltaY = 0;

			e.preventDefault();

			if (e.deltaY) { // FireFox 17+ (IE9+, Chrome 31+?)
				deltaY = e.deltaY;
			} else if (e.wheelDelta) {
				deltaY = -e.wheelDelta;
			}

			// As far as I know, there is no good cross-browser way to get the cursor position relative to the event target.
			// We have to calculate the target element's position relative to the document, and subtrack that from the
			// cursor's position relative to the document.
			var rect = img.parentElement.getBoundingClientRect();
			var offsetX = e.pageX - rect.left - window.pageXOffset;
			var offsetY = e.pageY - rect.top - window.pageYOffset;

			// Record the offset between the bg edge and cursor:
			var bgCursorX = offsetX - bgPosX;
			var bgCursorY = offsetY - bgPosY;
			
			// Use the previous offset to get the percent offset between the bg edge and cursor:
			var bgRatioX = bgCursorX/bgWidth;
			var bgRatioY = bgCursorY/bgHeight;

			// Update the bg size:
			if (deltaY < 0) {
				bgWidth += bgWidth*settings.zoom;
				bgHeight += bgHeight*settings.zoom;
			} else {
				bgWidth -= bgWidth*settings.zoom;
				bgHeight -= bgHeight*settings.zoom;
			}

			if (settings.maxZoom) {
				bgWidth = Math.min(width*settings.maxZoom, bgWidth);
				bgHeight = Math.min(height*settings.maxZoom, bgHeight);
			}

			// Take the percent offset and apply it to the new size:
			bgPosX = offsetX - ((bgWidth) * bgRatioX);
			bgPosY = offsetY - ((bgHeight) * bgRatioY);

			// Prevent zooming out beyond the starting size
			if (bgWidth <= width || bgHeight <= height) {
				reset();
			} else {
				updateBgStyle();
			}
		}

		function drag(e) {
			e.preventDefault();
			bgPosX += (e.pageX - previousEvent.pageX);
			bgPosY += (e.pageY - previousEvent.pageY);
			previousEvent = e;
			updateBgStyle();
		}

		function removeDrag() {
			document.removeEventListener('mouseup', removeDrag);
			document.removeEventListener('mousemove', drag);
		}

		// Make the background draggable
		function draggable(e) {
			e.preventDefault();
			previousEvent = e;
			document.addEventListener('mousemove', drag);
			document.addEventListener('mouseup', removeDrag);
		}

		// (INITIAL) LOADING
		function load() {
			// don't calculate image, when trasparentSpaceFiller already loaded
			if (img.src === transparentSpaceFiller) return;
			
			// get the container of the image
			var ct = img.parentElement.getBoundingClientRect();
			ctWidth = ct.width;
			ctHeight = ct.height;
			
			// get dimensions of image
			var initial = Math.max(settings.initialZoom, 1);
			var computedStyle = window.getComputedStyle(img, null);
			width = parseInt(computedStyle.width, 10);
			height = parseInt(computedStyle.height, 10);

			bgWidth = width * initial;
			bgHeight = height * initial;
			bgPosX = (ctWidth - bgWidth) * settings.initialX;
			bgPosY = (ctHeight - bgHeight) * settings.initialY;
			setSrcToBackground(img);

			img.style.backgroundSize = bgWidth+'px '+bgHeight+'px';
			img.style.backgroundPosition = bgPosX+'px '+bgPosY+'px';
			img.addEventListener('wheelzoom.reset', reset);

			img.addEventListener('wheel', onwheel);
			img.addEventListener('mousedown', draggable);
		}
		// END (INITIAL) LOADING

		var destroy = function (originalProperties) {
			img.removeEventListener('wheelzoom.destroy', destroy);
			img.removeEventListener('wheelzoom.reset', reset);
			img.removeEventListener('load', load);
			img.removeEventListener('mouseup', removeDrag);
			img.removeEventListener('mousemove', drag);
			img.removeEventListener('mousedown', draggable);
			img.removeEventListener('wheel', onwheel);

			img.style.backgroundImage = originalProperties.backgroundImage;
			img.style.backgroundRepeat = originalProperties.backgroundRepeat;
			img.src = originalProperties.src;
		}.bind(null, {
			backgroundImage: img.style.backgroundImage,
			backgroundRepeat: img.style.backgroundRepeat,
			src: img.src
		});

		img.addEventListener('wheelzoom.destroy', destroy);

		options = options || {};
		Object.keys(defaults).forEach(function(key){
			settings[key] = options[key] !== undefined ? options[key] : defaults[key];
		});

		if (img.complete) { load(); }
		img.addEventListener('load', load);
	};
	// END MAIN

	// Do nothing in IE9 or below
	if (typeof window.btoa !== 'function') {
		return function(elements) {
			return elements;
		};
	} else {
		return function(elements, options) {
			if (elements && elements.length) {
				Array.prototype.forEach.call(elements, function (node) {
					main(node, options);
				});
			} else if (elements && elements.nodeName) {
				main(elements, options);
			}
			return elements;
		};
	}
}());
