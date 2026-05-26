<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    // Truncate the table first to insert the fresh, clean FAQs
    DB::table('faq')->truncate();

    $faqs = [
        [
            'title' => 'What is Sirona and how can it benefit my school?',
            'description' => 'Sirona is an all-in-one, cloud-based school management platform designed to streamline administrative operations, improve teacher-parent communication, and manage academic records. By automating manual processes, Sirona helps schools save up to 40% in administrative hours and reduce paperwork entirely.'
        ],
        [
            'title' => 'Can parents track their child\'s academic performance in real-time?',
            'description' => 'Yes! Sirona features a dedicated parent portal and mobile access. Parents can view live attendance logs, exam report cards, daily homework, fee invoices, and teacher remarks instantly, keeping them fully engaged in their child\'s education.'
        ],
        [
            'title' => 'How secure is our school\'s data on Sirona?',
            'description' => 'Security is our top priority. Sirona uses enterprise-grade SSL encryption and role-based access control (RBAC). This ensures that student records, financial information, and academic databases are protected and only accessible to authorized personnel.'
        ],
        [
            'title' => 'Does Sirona support online school fee payments?',
            'description' => 'Absolutely. Sirona integrates with leading secure payment gateways (like Stripe, PayPal, Flutterwave, and Paystack). Parents can pay tuition and other fees online, and the system automatically generates digital receipts and updates the accountant\'s ledger.'
        ],
        [
            'title' => 'How long does it take to set up and onboard our school?',
            'description' => 'Getting started is quick and easy. Our wizard onboarding can set up your basic school profile in minutes. Most schools fully transition their database and staff within 3 to 5 business days, guided by our dedicated support team.'
        ],
        [
            'title' => 'Can teachers manage exams, grading, and report cards online?',
            'description' => 'Yes, Sirona includes a powerful academic module. Teachers can record marks, manage exams, compute GPA/grade points automatically, and generate professional, ready-to-print report cards with just a few clicks.'
        ],
        [
            'title' => 'Is there a student attendance tracking system?',
            'description' => 'Yes. Teachers can mark daily attendance digitally in under a minute. Parents receive automated notifications if their child is marked absent, ensuring student safety and accountability.'
        ],
        [
            'title' => 'Can Sirona be customized to match our school\'s grading system and report card layouts?',
            'description' => 'Yes! Sirona is highly flexible. Admins can configure custom grade scales, GPA calculations, and class divisions. Report cards can be fully customized with school branding, logos, and specific remarks to meet your school\'s unique academic standards.'
        ],
        [
            'title' => 'What kind of customer support do you offer?',
            'description' => 'We offer 24/7 priority email and ticket support, along with comprehensive video tutorials and documentation. For premium plans, schools are assigned a dedicated onboarding manager to assist with setup and staff training.'
        ],
        [
            'title' => 'Are there any hidden setup fees, and what are the pricing plans?',
            'description' => 'No hidden fees. Best of all, Sirona is completely free to use for now! You can register your school, add administrators, manage student enrollment, and explore all core features without any subscription cost.'
        ]
    ];

    foreach ($faqs as $faq) {
        DB::table('faq')->insert($faq);
    }

    echo "SUCCESS: Seeded 10 professional FAQs into the 'faq' table.\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
