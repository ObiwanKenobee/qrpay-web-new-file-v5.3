<?php

namespace Database\Seeders\Update;

use Illuminate\Database\Seeder;
use Database\Seeders\Admin\SectionHasPageSeeder;
use Database\Seeders\Admin\TransactionSettingSeeder;

class VersionUpdateSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //version Update Seeders
        $this->call([
            AppSettingsSeeder::class,
            BasicSettingsSeeder::class,
            TransactionSettingSeeder::class,
            VirtualApiSeeder::class,
            PaymentGatewaySeeder::class,
            SectionHasPageSeeder::class,
        ]);



    }
}
