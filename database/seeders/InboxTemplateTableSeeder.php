<?php

namespace Database\Seeders;

use App\Models\InboxTemplate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InboxTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'user_id' => 1,
                'template_name' => 'Default Template',
                'preview_message' => '[Hi|Hey|Hello] [first_name] [last_name], This is a default sms template for testing.',
                'status' => 1,
            ],
            [
                'user_id' => 1,
                'template_name' => 'Starter Template',
                'preview_message' => '[Hi|Hey|Hello] [first_name] [last_name], I am from TextTorrent. Your number [phone_number] has been added to my contacts. Thanks.',
                'status' => 1,
            ]
        ];

        InboxTemplate::insert($templates);
    }
}
