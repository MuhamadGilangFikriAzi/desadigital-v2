<?php
$log = file_get_contents('/var/www/html/storage/logs/laravel.log');
$lines = explode("\n", $log);
$errors = [];
foreach ($lines as $line) {
    if (preg_match('/^\[.*\] local\./', $line)) {
        $errors[] = $line;
    }
}
// Show last 5 errors
$total = count($errors);
$start = max(0, $total - 5);
for ($i = $start; $i < $total; $i++) {
    echo $errors[$i] . "\n";
    echo "---\n";
}
