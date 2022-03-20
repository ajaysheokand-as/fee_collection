<?php

// $data = json_decode(file_get_contents('php://input'), true);
$file = fopen("callback.json", "a");
fwrite($file, (file_get_contents('php://input') . "\n"));
fclose($file);
