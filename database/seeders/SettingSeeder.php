<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'key' => 'site_general_name',
                'value' => 'Website Name',
            ],
            [
                'key' => 'site_general_textarea_description',
                'value' => 'Website Description',
            ],
            [
                'key' => 'site_general_logo',
                'value' => 'assets/images/your-logo.webp',
            ],
            [
                'key' => 'site_general_favicon',
                'value' => 'assets/images/favicon.webp',
            ],
            [
                'key' => 'site_general_email',
                'value' => null,
            ],
            [
                'key' => 'site_general_phone',
                'value' => null,
            ],
            [
                'key' => 'site_general_address',
                'value' => null,
            ],

            [
                'key' => 'site_general_delivery_charges',
                'value' => 0,
            ],
            [
                'key' => 'site_general_terms_conditions',
                'value' => null,
            ],
            [
                'key' => 'site_general_privacy_policy',
                'value' => null,
            ],
            [
                'key' => 'site_general_copyright',
                'value' => null,
            ],
           
            [
                'key' => 'site_general_facebook',
                'value' => null,
            ],
            [
                'key' => 'site_general_twitter',
                'value' => null,
            ],
            [
                'key' => 'site_general_instagram',
                'value' => null,
            ],
            [
                'key' => 'site_general_linkedin',
                'value' => null,
            ],
            [
                'key' => 'site_general_youtube',
                'value' => null,
            ],

        ];

        Setting::query()->insert($data);
    }
}