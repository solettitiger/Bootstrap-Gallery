<?php
// EBID 2021
// #################################################################
// # Gallery Class into all View-Files (needs config.php too)
// #################################################################

class Gallery {
	public function __construct() {
	}
	
	public function getDirectories($path) {
		if(strpos(realpath($path),realpath(IMG_DIR)) === 0) { // sicherstellen, dass kein Dateien außerhalb des "Root-Pfades" der Anwendung angesurft werden können
			$dirs = glob($path.'/*',GLOB_ONLYDIR);
			if(IMG_SORT_GALLERY == 'up') { sort($dirs); }
			if(IMG_SORT_GALLERY == 'down') { rsort($dirs); }
			return $dirs;
		} else {
			return false;
		}
	}
	
	public function getFiles($path) {
		$path = (IMG_DIR.'/'.$path);
		if(strpos(realpath($path),realpath(IMG_DIR)) === 0) { // sicherstellen, dass kein Dateien außerhalb des "Root-Pfades" der Anwendung angesurft werden können
			$files = glob($path.'/*.*');
			if(IMG_SORT_IMAGES == 'up') { sort($files); }
			if(IMG_SORT_IMAGES == 'down') { rsort($files); }
			$i = 0;
			foreach($files as $file) {
				if(is_file($file)) {
					$ii = pathinfo($file);
					if(!in_array(strtolower($ii['extension']),IMG_TYPES)) { unset($files[$i]); }
				} else { unset($files[$i]); }
				$i++;
			}
			return array_values($files);
		} else {
			return false;
		}
	}
	
	public function getFolderName($dir) {
		$xx = basename($dir);
		return str_replace(array('_'), array(' '), $xx);
	}

	public function getMainImageName($dir) { // eine Bilddatei vom Verzeichnis ermitteln
		$xx = basename($dir);
		$dd = IMG_PATH.$xx.'/';
		$files = glob($dir.'/*.*'); 
		foreach($files as $file) { // eine Datei die den Vorgabentypen entspricht suchen
			if(is_file($file)) {
				$ii = pathinfo($file);
				if(in_array(strtolower($ii['extension']),IMG_TYPES)) {
					return $dd.basename($file);
					exit;
				}
			}
		}
	}
	
	public function getImageFile($path,$file) {
		$xx = basename($file);
		$ii = pathinfo($file);
		if(in_array(strtolower($ii['extension']),IMG_TYPES)) {
			return IMG_PATH.$path.'/'.$xx;
		}
	}
	
	public function nextImage($path, $file) {
		$files = self::getFiles($path);
		$file = __DIR__.'/'.$file;
		$nn = count($files)-1;
		$ii = array_search($file,$files);
		
		if($ii >= $nn) { $ii = 0; } else { $ii++; }
		
		$nxtfile = substr($files[$ii],strlen(__DIR__)+1);
		return $nxtfile;
	}
	
	public function prevImage($path, $file) {
		$files = self::getFiles($path);
		$file = __DIR__.'/'.$file;
		$nn = count($files)-1;
		$ii = array_search($file,$files);
		
		if($ii <= 0) { $ii = $nn; } else { $ii--; }
		
		$prefile = substr($files[$ii],strlen(__DIR__)+1);
		return $prefile;
	}
	
}

//EOF
