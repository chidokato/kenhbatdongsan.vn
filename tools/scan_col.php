<?php
$im = imagecreatefromjpeg('c:/xampp/htdocs/www/kenhbds/tools/chi-can/assets/template-chi-can.jpg');
echo "Scanning column x=150 for y=380..520:\n";
for ($y = 380; $y <= 500; $y += 5) {
    $rgb = imagecolorat($im, 150, $y);
    printf("y=%d: #%06X\n", $y, $rgb & 0xFFFFFF);
}
