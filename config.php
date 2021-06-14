<?php
// EBID 2021
// #################################################################
// # Configuration
// #################################################################

// where are the folders with the images located?
define("IMG_DIR",__DIR__.'/images');

// what is the link to that folder?
define("IMG_PATH", 'images/');

// which image types are allowed?
//define("IMG_TYPES", array('jpg','gif','png')); 
const IMG_TYPES = array('jpg','gif','png'); // must use this when on PHP 5.6

// sort the image folders: upwards (up) or downwards (down)
define("IMG_SORT_GALLERY",'up'); 

// sort the images within folder: upwards (up) or downwards (down), first image is shown in overview
define("IMG_SORT_IMAGES",'up'); 

// titel of gallery (text only)
define("IMG_TITLE", 'BootstrapGallery'); 

// ABOUT: header and body(HTML)
define("IMG_ABOUT_HEADER", 'About');
define("IMG_ABOUT_BODY", "
Bootstrap-Gallery uses bootstrap 5 to create a gallery out of files in a directory. No database is required. There are three different detail pages to view the images:<br>
<ul>
<li>detail1.php shows the single image as big as possible.</li>
<li>detail2.php &nbsp; <i class='fa fa-fast-forward'></i> &nbsp; you can scroll horizontaly through all the images using the mousewheel.</li>
<li>detail3.php &nbsp; <i class='fa fa-eye'></i> &nbsp; you can resize the image with the mousewheel and drag the zoomed-in image for detailed viewing. Zooming and draging can also be made with a mobile device and touchscreen.</li>
</ul>
");

// CONTACT: header and body(HTML)
define("IMG_CONTACT_HEADER", 'Contact');
define("IMG_CONTACT_BODY", "
Get on Github: <a href='https://github.com/solettitiger/BootstrapGallery/'>github.com/solettitiger/BootstrapGallery</a><br>
Demo: <a href='http://demo.ebid.at/bilder'>demo.ebid.at/bilder</a><br>
<br> 
<i class='fa fa-envelope'></i> &nbsp; <a href='mailto:solettitiger@gmail.com'>solettitiger@gmail.com</a><br>
<i class='fa fa-globe'></i> &nbsp; <a href='https://www.elektronischesbuero.at' target='_blank'>www.elektronischesbuero.at</a>
");

//EOF
