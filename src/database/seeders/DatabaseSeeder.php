<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */


    public function run()
    {
         // 先にカテゴリを作成
        $this->call(CategoriesTableSeeder::class);

        // カテゴリが存在してからコンタクトを作成
        $this->call(ContactsTableSeeder::class);
    }
}
