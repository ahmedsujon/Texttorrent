<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getSetting = Setting::find(1);
        if (!$getSetting) {
            $setting = new Setting();
            $setting->favicon = '';
            $setting->logo = '';
            $setting->site_title = 'NzCoding - Laravel 10 CMS';
            $setting->copyright_text = 'Copyright 2023 © All Rights Reserved by NzCoding';
            $setting->save();
        }
    }
}
