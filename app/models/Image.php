<?php

namespace Model;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * Image manipulation
 */
class Image {
	
	public function resize($filename, $max_size = 700) {
		// code...
		// Check what kind of file type it is
		$type = mime_content_type($filename);

		if (file_exists($filename)) {
			// code...
			// image resource
			switch ($type) {
				case 'image/png':
					// code...
					$image = imagecreatefrompng($filename);
					break;

				case 'image/gif':
					// code...
					$image = imagecreatefromgif($filename);
					break;

				case 'image/jpeg':
					// code...
					$image = imagecreatefromjpeg($filename);
					break;

				case 'image/webp':
					// code...
					$image = imagecreatefromwebp($filename);
					break;
				
				default:
					// code...
					return $filename;
					break;
			}

			// width and height of that resource
			$src_w = imagesx($image);
			$src_h = imagesx($image);

			// Check which one is bigger. 
			// The width or height.
			if ($src_w > $src_h) {
				// code...
				// Reduce max size if image is smaller
				if ($src_w < $max_size) {
					// code...
					$max_size = $src_w;
				}

				$dst_w = $max_size;
				$dst_h = ($src_h / $src_w) * $max_size;
			} else {
				// Reduce max size if image is smaller
				if ($src_h < $max_size) {
					// code...
					$max_size = $src_h
				}

				$dst_w = ($src_w / $src_h) * $max_size;
				$dst_h = $max_size;

			}

			$dst_w = round($dst_w);
			$dst_h = round($dst_h);

			$dst_image = imagecreatetruecolor($dst_w, $dst_h);

			// if an image is a png file, we do this to reserve and remain transparent instead of putting a blanck background
			if ($type == 'image/png') {
				// code...
				imagealphablending($dst_image, false);
				imagesavealpha($dst_image, true);
			}

			imagecopyresampled($dst_image, $image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
			imagedestroy($image);

			switch ($type) {
				case 'image/png':
					// code...
					imagepng($dst_image, $filename, 8);
					break;

				case 'image/gif':
					// code...
					imagegif($dst_image, $filename);
					break;

				case 'image/jpeg':
					// code...
					imagejpeg($dst_image, $filename, 90);
					break;

				case 'image/webp':
					// code...
					imagewebp($dst_image, $filename, 90);
					break;
				
				default:
					// code...
					imagejpeg($dst_image, $filename, 90);
					break;
			}

			imagedestroy($dst_image);
		}
		return $filename;
	}
}
