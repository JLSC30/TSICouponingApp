<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $u = new User();
        $u->name = "Administrator";
        $u->email = 'ucompleteme@trainstation.com.ph';
        $u->password = bcrypt('JanLarry20');
        $u->save();

        $p = new Product();
        $p->sku = 'embracing-change';
        $p->name = 'Embracing Change';
        $p->save();

        $p = new Product();
        $p->sku = 'virtual-effectiveness';
        $p->name = 'Virtual Effectiveness';
        $p->save();

        $p = new Product();
        $p->sku = 'wfh101';
        $p->name = 'Working from Home Hacks	';
        $p->save();
    }
}
