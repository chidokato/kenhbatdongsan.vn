<?php
$im = imagecreatefromjpeg('c:/xampp/htdocs/www/kenhbds/tools/chi-can/assets/template-chi-can.jpg');
echo "Scanning row y=850 for x=480..520:\n";
for ($x = 480; $x <= 520; $x++) {
    $rgb = imagecolorat($im, $x, 850);
    printf("x=%d: #%06X\n", $x, $rgb & 0xFFFFFF);
}
