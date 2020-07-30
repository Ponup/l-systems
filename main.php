<?php declare(strict_types=1);

require 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

if($argc != 2) {
	fprintf(STDERR, "usage: %s <definition file>\n", $argv[0]);
	exit(1);
}

$filename = $argv[1];
$config = Yaml::parseFile($filename, Yaml::PARSE_OBJECT_FOR_MAP);

$lsystem = new Lsystem($config);
$outputSequence = $lsystem->run();

$turtle = new Turtle($config->step, $config->angle->increment, $config->angle->initial);
$turtle->moveTo(1024, 1024);

$renderer = new TurtleRenderer($turtle);

$im = imagecreate(2048, 2048);
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);

$renderer->render($outputSequence, $im, $black);

$croppedImage = imagecropauto($im, IMG_CROP_SIDES);
imagedestroy($im);
$x = imagesx($croppedImage);
$y = imagesy($croppedImage);
$paddedImage = imagecreate($x + 10, $y + 10);
$white = imagecolorallocate($paddedImage, 255, 255, 255);
imagecopyresized($paddedImage, $croppedImage, 5, 5, 0, 0, $x, $y, $x, $y);
imagedestroy($croppedImage);
imagepng($paddedImage, basename($filename, '.yaml') . '.png');
imagedestroy($paddedImage);

