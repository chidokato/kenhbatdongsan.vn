<?php
$im = imagecreatefromjpeg('c:/xampp/htdocs/www/kenhbds/tools/chi-can/assets/template-chi-can.jpg');
$w = imagesx($im);
$h = imagesy($im);
echo "Image dimensions: {$w} x {$h}\n";

// Let's find all 4 frames by detecting white regions
// A pixel is considered white if R, G, B > 250
// Let's scan horizontally across the whole image at y=300, y=550, y=850
for ($y = 0; $y < $h; $y += 50) {
    $white_count = 0;
    for ($x = 0; $x < $w; $x++) {
        $rgb = imagecolorat($im, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        if ($r > 240 && $g > 240 && $b > 240) {
            $white_count++;
        }
    }
    echo "y=$y: white_count=$white_count\n";
}
