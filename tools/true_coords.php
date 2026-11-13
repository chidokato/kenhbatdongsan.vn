<?php
$im = imagecreatefromjpeg('c:/xampp/htdocs/www/kenhbds/tools/chi-can/assets/template-chi-can.jpg');

function is_w($im, $x, $y) {
    $rgb = imagecolorat($im, $x, $y);
    $r = ($rgb >> 16) & 0xFF; $g = ($rgb >> 8) & 0xFF; $b = $rgb & 0xFF;
    return ($r > 235 && $g > 235 && $b > 235);
}

// 1. Frame 1: inside x=30..330, y=210..450
$x1 = 999; $x2 = 0; $y1 = 999; $y2 = 0;
for ($y = 210; $y <= 450; $y++) {
    for ($x = 30; $x <= 330; $x++) {
        if (is_w($im, $x, $y)) {
            $x1 = min($x1, $x); $x2 = max($x2, $x);
            $y1 = min($y1, $y); $y2 = max($y2, $y);
        }
    }
}
echo "FRAME 1 exact: x=$x1, y=$y1, w=" . ($x2 - $x1 + 1) . ", h=" . ($y2 - $y1 + 1) . " (x2=$x2, y2=$y2)\n";

// 2. Frame 2: inside x=30..800, y=450..730
$x1 = 999; $x2 = 0; $y1 = 999; $y2 = 0;
for ($y = 450; $y <= 730; $y++) {
    for ($x = 30; $x <= 800; $x++) {
        if (is_w($im, $x, $y)) {
            $x1 = min($x1, $x); $x2 = max($x2, $x);
            $y1 = min($y1, $y); $y2 = max($y2, $y);
        }
    }
}
echo "FRAME 2 exact: x=$x1, y=$y1, w=" . ($x2 - $x1 + 1) . ", h=" . ($y2 - $y1 + 1) . " (x2=$x2, y2=$y2)\n";

// 3. Frame 3: inside x=30..500, y=730..1005
$x1 = 999; $x2 = 0; $y1 = 999; $y2 = 0;
for ($y = 730; $y <= 1005; $y++) {
    for ($x = 30; $x <= 500; $x++) {
        if (is_w($im, $x, $y)) {
            $x1 = min($x1, $x); $x2 = max($x2, $x);
            $y1 = min($y1, $y); $y2 = max($y2, $y);
        }
    }
}
echo "FRAME 3 exact: x=$x1, y=$y1, w=" . ($x2 - $x1 + 1) . ", h=" . ($y2 - $y1 + 1) . " (x2=$x2, y2=$y2)\n";

// 4. Frame 4: inside x=480..800, y=730..1005
$x1 = 999; $x2 = 0; $y1 = 999; $y2 = 0;
for ($y = 730; $y <= 1005; $y++) {
    for ($x = 480; $x <= 800; $x++) {
        if (is_w($im, $x, $y)) {
            $x1 = min($x1, $x); $x2 = max($x2, $x);
            $y1 = min($y1, $y); $y2 = max($y2, $y);
        }
    }
}
echo "FRAME 4 exact: x=$x1, y=$y1, w=" . ($x2 - $x1 + 1) . ", h=" . ($y2 - $y1 + 1) . " (x2=$x2, y2=$y2)\n";
