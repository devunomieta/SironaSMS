<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    $updatedSettings = 0;
    $settings = DB::table('global_settings')->where('value', 'like', '%Ekattor%')->get();
    foreach ($settings as $setting) {
        $newValue = str_replace(['Ekattor8', 'Ekattor 8', 'Ekattor'], 'Sirona', $setting->value);
        DB::table('global_settings')->where('id', $setting->id)->update(['value' => $newValue]);
        $updatedSettings++;
    }

    $updatedFaqs = 0;
    $faqs = DB::table('faq')->where('title', 'like', '%Ekattor%')->orWhere('description', 'like', '%Ekattor%')->get();
    foreach ($faqs as $faq) {
        $newTitle = str_replace(['Ekattor8', 'Ekattor 8', 'Ekattor'], 'Sirona', $faq->title);
        $newDesc = str_replace(['Ekattor8', 'Ekattor 8', 'Ekattor'], 'Sirona', $faq->description);
        DB::table('faq')->where('id', $faq->id)->update(['title' => $newTitle, 'description' => $newDesc]);
        $updatedFaqs++;
    }

    echo "SUCCESS: Updated $updatedSettings settings and $updatedFaqs FAQs in the database.\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
