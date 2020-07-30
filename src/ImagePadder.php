<?php declare(strict_types=1);

class ImagePadder {

	public function addPadding($inputImage, int $padding) {
		$x = imagesx($inputImage);
		$y = imagesy($inputImage);
		$paddedImage = imagecreate($x + ($padding << 1), $y + ($padding << 1));
		$white = imagecolorallocate($paddedImage, 255, 255, 255);
		imagecopyresized($paddedImage, $inputImage, $padding, $padding, 0, 0, $x, $y, $x, $y);
		imagedestroy($inputImage);
		return $paddedImage;
	}
}
