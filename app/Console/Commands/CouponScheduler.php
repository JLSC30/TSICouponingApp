<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        $public_runs = ['public', 'runs', 'public_runs'];
        $contains = Str::contains($product, $public_runs);
        foreach ($product as $p)
        {
            if(!($contains))
            {
                if($p->coupon->where('status', 'Unused')->count() <= 20)
                {
                    $data = [
                        'product' => $p->name,
                        'count' => $p->coupon->where('status', 'Unused')->count(),
                    ];
                    Mail::send('pages.email.index', $data, function($message) {
                        $message->to(config('app.admin_email'), config('app.admin_name'))->subject
                            ('Coupon App email alert');
                        $message->from(config('app.mail_username'), config('app.name'));
                    });
                }
                $this->info('Email alert successfully sent.');
            }            
        }
    }
}
