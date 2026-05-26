<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$settings = App\Models\GlobalSettings::where('key', 'like', '%currency%')->get();
foreach ($settings as $s) {
    echo "Key: " . $s->key . " | Value: " . $s->value . "\n";
}
