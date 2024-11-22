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

        for ($i = 0; $i < 10; $i++) {
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

        $lists2 = ['List A', 'List B'];
        $folders2 = ['Folder A', 'Folder B'];

        foreach ($lists2 as $key => $list2) {
            $contactList2 = new ContactList();
            $contactList2->user_id = 2;
            $contactList2->name = $list2;
            $contactList2->bookmarked = $key <= 1 ? 1 : 0;
            $contactList2->save();
        }
        foreach ($folders2 as $key => $folder2) {
            $contactList2 = new ContactFolder();
            $contactList2->user_id = 2;
            $contactList2->name = $folder2;
            $contactList2->save();
        }

        $contact2 = new Contact();
        $contact2->user_id = 2;
        $contact2->first_name = 'TextTorrent';
        $contact2->last_name = 'Owner';
        $contact2->number = '+13472102794';
        $contact2->company = 'TextTorrent';
        $contact2->list_id = 6;
        $contact2->folder_id = 6;
        $contact2->save();

        for ($i = 0; $i < 5; $i++) {
            $faker = Faker::create();

            $contact2 = new Contact();
            $contact2->user_id = 2;
            $contact2->first_name = $faker->firstName;
            $contact2->last_name = $faker->lastName;
            $contact2->number = '+1' . $faker->numerify('##########');
            $contact2->company = $faker->company();
            $contact2->list_id = 6;
            $contact2->folder_id = 6;
            $contact2->save();
        }
    }
}
