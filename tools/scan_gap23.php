<?php
$im = imagecreatefromjpeg('c:/xampp/htdocs/www/kenhbds/tools/chi-can/assets/template-chi-can.jpg');
echo "Scanning column x=200 for y=660..730:\n";
for ($y = 660; $y <= 730; $y += 2) {
    $rgb = imagecolorat($im, 200, $y);
    printf("y=%d: #%06X\n", $y, $rgb & 0xFFFFFF);
}
