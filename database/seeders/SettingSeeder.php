<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'NewsRealm',
            'site_email' => 'support@newsrealm.live',
            'company_address' => 'United Kingdom',
        ];

        foreach ($settings as $key => $value) {
            Setting::create(compact('key', 'value'));
        }
    }
}
