<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CouponScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupon:alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will alert the admin if the available coupon drop below specific number';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $product = Product::with('coupon')->get();
        foreach ($product as $p)
        {
            if($p->coupon->where('status', 'Unused')->count() <= 100)
            {
                $data = [
                    'product' => $p->name,
                    'count' => $p->coupon->where('status', 'Unused')->count(),
                ];
                Mail::send('pages.email.index', $data, function($message) {
                    $message->to(env('ADMIN_EMAIL'), env('ADMIN_NAME'))->subject
                        ('Coupon App email alert');
                    $message->from(env('MAIL_USERNAME'),env('MAIL_FROM_NAME'));
                });
            }
            $this->info('Email alert successfully sent.');
        }
    }
}
