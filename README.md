# Bootstrap-Gallery

Bootstrap-Gallery uses bootstrap 5 to create a gallery out of files in a directory. No database is required. Only images are shown, no destracting Text. In the overview the foldernames work as description.

There are three different pages to view the images:
- detail1.php provides the overview of the images in the chosen directory and shows the single image as big as possible.
- detail2.php <i class='fa fa-fast-forward'></i> resizes the images to fit the height of the browser and you can scroll through all the images using the mousewheel.
- detail3.php <i class='fa fa-eye'></i> fits the image into the browser and you can resize the image with the mousewheel and drag the zoomed-in image for detailed viewing. Zooming and draging can also be made with a mobile device and touchscreen.


## Requirements
- Webserver with at least PHP 5.6 is needed. 
- Privilege to write to all the images folders for cronResizer to store the resized images.
- Privilege to write to the tmp folder to store the thumbnails.


## Installation
Put all the files from the zip-file to a folder on your webserver. Edit the config.php in the root-folder to change the folder where you host your images (preset to /images) and which types of images you are allowing to be shown (e.g. jpg, gif, png).

Now copy all your images from your camera to a directory into the /images - folder. This can look like this:
```
/images/
	/Cracy_Cloud_Images/
		picture01.jpg
		picture02.jpg
	/My_Wedding_Images/
		20200517_172345.jpg
	/Last_Birthday_Celebration/
		20210622_140005.jpg
		20210622_140018.jpg
		20210622_140025.jpg
```
No nested galleries for now. Maybe someone wants to implement it ;-)

Use cronResizer.php (https://gihub.com/solettitiger/cronResizer) to resize your images. 


## Demo
Demo: http://demo.ebid.at/bilder/


## Relies on
The gallery takes advantage from the following projects:
- https://github.com/manuelstofer/pinchzoom PinchZoom is a Javascript library providing multi-touch gestures for zooming and dragging
- https://github.com/jackmoore/wheelzoom script for zooming image elements with the mousewheel/trackpad
- https://github.com/ioulian/Thumbnailer Thumbnailer is a fast and easy to use image resize script.
- https://getbootstrap.com/ framework for building mobile-first sites
- https://jquery.com jQuery JavaScript library
- https://fontawesome.com/ icon library


## Pictures 
No pictures included. See http://demo.ebid.at/bilder/ for a demo.


## License
Licensed under the [MIT License](https://opensource.org/licenses/MIT). For the software, this one relies on, please refer to the relevant regulations there.

