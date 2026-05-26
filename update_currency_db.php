<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$affected = App\Models\GlobalSettings::where('key', 'system_currency')->update(['value' => '₦']);
echo "Updated currency in global_settings: " . $affected . " row(s).\n";
