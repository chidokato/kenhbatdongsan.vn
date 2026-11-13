<?php
$im = imagecreatefromjpeg('c:/xampp/htdocs/www/kenhbds/tools/chi-can/assets/template-chi-can.jpg');
$w = imagesx($im);
$h = imagesy($im);

function is_white($im, $x, $y) {
    $rgb = imagecolorat($im, $x, $y);
    $r = ($rgb >> 16) & 0xFF;
    $g = ($rgb >> 8) & 0xFF;
    $b = $rgb & 0xFF;
    return ($r > 240 && $g > 240 && $b > 240);
}

// Check vertical profile of Frame 1 (x around 150)
$f1_y_start = -1; $f1_y_end = -1;
for ($y = 150; $y < 500; $y++) {
    if (is_white($im, 150, $y)) {
        if ($f1_y_start === -1) $f1_y_start = $y;
        $f1_y_end = $y;
    }
}
// Check horizontal profile of Frame 1 (y around 300)
$f1_x_start = -1; $f1_x_end = -1;
for ($x = 20; $x < 400; $x++) {
    if (is_white($im, $x, 300)) {
        if ($f1_x_start === -1) $f1_x_start = $x;
        $f1_x_end = $x;
    }
}
echo "FRAME 1: x from $f1_x_start to $f1_x_end (w=" . ($f1_x_end - $f1_x_start + 1) . "), y from $f1_y_start to $f1_y_end (h=" . ($f1_y_end - $f1_y_start + 1) . ")\n";

// Check vertical profile of Frame 2 (x around 400)
$f2_y_start = -1; $f2_y_end = -1;
for ($y = 400; $y < 750; $y++) {
    if (is_white($im, 400, $y)) {
        if ($f2_y_start === -1) $f2_y_start = $y;
        $f2_y_end = $y;
    }
}
$f2_x_start = -1; $f2_x_end = -1;
for ($x = 20; $x < 800; $x++) {
    if (is_white($im, $x, 550)) {
        if ($f2_x_start === -1) $f2_x_start = $x;
        $f2_x_end = $x;
    }
}
echo "FRAME 2: x from $f2_x_start to $f2_x_end (w=" . ($f2_x_end - $f2_x_start + 1) . "), y from $f2_y_start to $f2_y_end (h=" . ($f2_y_end - $f2_y_start + 1) . ")\n";

// Check Frame 3 (x around 200) and Frame 4 (x around 650)
$f3_y_start = -1; $f3_y_end = -1;
for ($y = 650; $y < 1010; $y++) {
    if (is_white($im, 200, $y)) {
        if ($f3_y_start === -1) $f3_y_start = $y;
        $f3_y_end = $y;
    }
}
$f3_x_start = -1; $f3_x_end = -1;
for ($x = 20; $x < 550; $x++) {
    if (is_white($im, $x, 800)) {
        if ($f3_x_start === -1) $f3_x_start = $x;
        $f3_x_end = $x;
    }
}
echo "FRAME 3: x from $f3_x_start to $f3_x_end (w=" . ($f3_x_end - $f3_x_start + 1) . "), y from $f3_y_start to $f3_y_end (h=" . ($f3_y_end - $f3_y_start + 1) . ")\n";

$f4_y_start = -1; $f4_y_end = -1;
for ($y = 650; $y < 1010; $y++) {
    if (is_white($im, 650, $y)) {
        if ($f4_y_start === -1) $f4_y_start = $y;
        $f4_y_end = $y;
    }
}
$f4_x_start = -1; $f4_x_end = -1;
for ($x = 450; $x < 800; $x++) {
    if (is_white($im, $x, 800)) {
        if ($f4_x_start === -1) $f4_x_start = $x;
        $f4_x_end = $x;
    }
}
echo "FRAME 4: x from $f4_x_start to $f4_x_end (w=" . ($f4_x_end - $f4_x_start + 1) . "), y from $f4_y_start to $f4_y_end (h=" . ($f4_y_end - $f4_y_start + 1) . ")\n";
