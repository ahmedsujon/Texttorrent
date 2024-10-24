<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\ContactFolder;
use App\Models\ContactList;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = ['List A', 'List B', 'List C', 'List D', 'List E'];
        $folders = ['Folder A', 'Folder B', 'Folder C', 'Folder D', 'Folder E'];

        foreach ($lists as $key => $list) {
            $contactList = new ContactList();
            $contactList->user_id = 1;
            $contactList->name = $list;
            $contactList->bookmarked = $key <= 1 ? 1 : 0;
            $contactList->save();
        }
        foreach ($folders as $key => $folder) {
            $contactList = new ContactFolder();
            $contactList->user_id = 1;
            $contactList->name = $folder;
            $contactList->save();
        }

        $contact = new Contact();
        $contact->user_id = 1;
        $contact->first_name = 'TextTorrent';
        $contact->last_name = 'Owner';
        $contact->number = '+13472102794';
        $contact->company = 'TextTorrent';
        $contact->list_id = 1;
        $contact->folder_id = 1;
        $contact->save();

        for ($i = 0; $i < 50; $i++) {
            $faker = Faker::create();

            $contact = new Contact();
            $contact->user_id = 1;
            $contact->first_name = $faker->firstName;
            $contact->last_name = $faker->lastName;
            $contact->number = '+1' . $faker->numerify('##########');
            $contact->company = $faker->company();
            $contact->list_id = 2;
            $contact->folder_id = 2;
            $contact->save();
        }
    }
}
