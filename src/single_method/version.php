<?php
function auto_version($file) {
    // if it is not a valid path (example: a CDN url)
    if (strpos($file, '/') !== 0 || !file_exists($_SERVER['DOCUMENT_ROOT'] . $file)) return $file;

    // retrieving the file modification time
    // https://www.php.net/manual/en/function.filemtime.php
    $mtime = filemtime($_SERVER['DOCUMENT_ROOT'] . $file);

    return sprintf("%s?v=%d", $file, $mtime);
}