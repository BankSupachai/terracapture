<?php
$files = scandir(".");
foreach($files as $file) {
    if($file != "." && $file != ".." && $file != "index.php") {
        echo "<a href='./$file'>$file</a><br>";
    }
}
?>
