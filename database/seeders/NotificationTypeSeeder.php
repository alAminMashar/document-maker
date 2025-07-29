<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NotificationType;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        NotificationType::create([
            'name'          =>  'SMS',
            'description'   =>  'Text Message Notification'
        ]);

        NotificationType::create([
            'name'          =>  'Email',
            'description'   =>  'Email Notification'
        ]);

        NotificationType::create([
            'name'          =>  'Letter',
            'description'   =>  'Postal Mail Notification'
        ]);

    }
}
