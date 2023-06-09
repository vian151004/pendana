<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Setting::query()->updateOrCreate(
        [
            'email' => 'support@gmail.com'
        ],
        [
            'email' => 'support@gmail.com',
            'phone' => '123456789',
            'work_hours' => 'Senin - Jum\'at, 08:00 s/d 16:00',
            'owner_name' => 'Administrator',
            'company_name' => 'Pendana',
            'short_description' => '-',
            'keyword' => '-',
            'about' => '-',
            'address' => '-',
            'postal_code' => 12345,
            'city' => '-',
            'province' => '-',
            'instagram_link' => '-',
            'twitter_link' => '-',
            'facebook_link' => '-',
            'google_plus_link' => '-'
        ]);   
    }
}
