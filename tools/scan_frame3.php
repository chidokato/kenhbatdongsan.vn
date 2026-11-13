<?php
$im = imagecreatefromjpeg('c:/xampp/htdocs/www/kenhbds/tools/chi-can/assets/template-chi-can.jpg');
echo "Scanning column x=200 for y=728..750:\n";
for ($y = 728; $y <= 750; $y++) {
    $rgb = imagecolorat($im, 200, $y);
    printf("y=%d: #%06X\n", $y, $rgb & 0xFFFFFF);
}
echo "Scanning column x=200 for y=980..1010:\n";
for ($y = 980; $y <= 1010; $y++) {
    $rgb = imagecolorat($im, 200, $y);
    printf("y=%d: #%06X\n", $y, $rgb & 0xFFFFFF);
}
