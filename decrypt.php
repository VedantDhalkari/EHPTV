<?php
$folder = __DIR__ . "/uploads/";
$files = scandir($folder);

foreach ($files as $file) {
    if ($file != "." && $file != "..") {

        // Only decrypt locked files
        if (str_ends_with($file, ".locked")) {

            $originalName = str_replace(".locked", "", $file);
            rename($folder . $file, $folder . $originalName);
        }
    }
}

?>