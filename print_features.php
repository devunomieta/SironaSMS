<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;
$features = DB::table('frontend_features')->get();
foreach ($features as $f) {
    echo "ID: " . $f->id . " | Title: " . $f->title . "\n";
}
